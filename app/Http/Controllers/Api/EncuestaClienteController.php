<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Encuesta as EncuestaResource;
use App\Http\Resources\ECV as ECVResource;
use App\Http\Resources\ECVExport as ECVExportResource;

use App\Encuesta;
use Illuminate\Support\Facades\DB;

class EncuestaClienteController extends Controller
{  
   
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string',            
            'tipo_encuesta'=>'required|exists:tipo_encuesta,id',
            'fecha_inicio' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
       
        $encuesta = new \App\Encuesta();
        $encuesta->descripcion = $request->get('descripcion');
        $encuesta->inicio = $request->get('fecha_inicio');
        $tipo_encuesta = \App\Tipo_Encuesta::findOrFail($request->get('tipo_encuesta'));
        $encuesta->tipo_encuesta()->associate($tipo_encuesta);
        $encuesta->save();
        
        return response()->json($encuesta);
    }
    public function show($encuesta_id) //Ver Encuesta - reporte
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        //$encuesta_completa = EncuestaResource::collection($encuesta); 
        return response()->json($encuesta);       
    }
 
    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string',  
            'fecha_inicio' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $encuesta = \App\Encuesta::findOrFail($id);
        if($encuesta){
            $empezo = (new DateTime($encuesta->inicio))->diff(new DateTime())->format('%R');
            //$termino = (new DateTime($this->termino))->diff(new DateTime())->format('%R');
            if($empezo == '-'){ // es porque esta Inactivo, por lo que puede ser editado y eliminado                
                $encuesta->descripcion = $request->get('descripcion');
                $encuesta->inicio = $request->get('fecha_inicio');               
                $encuesta->save();
                return response()->json('ok');
            }
            else{
                return response()->json('fail');
            }
        }
    }
        public function destroy($id)
    {
        $encuesta = \App\Encuesta::findOrFail($id);
        $count = \App\EncuestaCliente::encuesta($id)->date()->count();
        if($encuesta){
            $empezo = (new DateTime($encuesta->inicio))->diff(new DateTime())->format('%R');
            //$termino = (new DateTime($this->termino))->diff(new DateTime())->format('%R');
            if($count <= 0){ // es porque esta Inactivo, por lo que puede ser editado y eliminado
                 $encuesta->delete();
                 return response()->json('ok');
            }
            else{
                return response()->json('fail');
            }
        }
    }
    public function file (Request $request, $encuesta_id){
        $validator = Validator::make($request->all(), [
            'csv' => 'required|file'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $encuesta->clientes()->detach(); //Probar 
        if($request->hasFile('csv')){
            $csv = $request->file('csv');

            DB::beginTransaction();
             
            try {
                $encuesta_clientes = (new FastExcel)->import($csv, function ($line) use ($encuesta){
                    $cliente = \App\Cliente::all()->where('codigo','=',$line['codigo'])->first();
                        $fecha = null;$telefono=null;$email =null;
                    
                        if($line['fecha_nacimiento']){
                            $fecha = Carbon::parse($line['fecha_nacimiento'])->format('Y-m-d');
                        }
                        if($line['telefono']){
                            $telefono = $line['telefono'];
                        }
                        if($line['email']){
                            $email = $line['email'];
                        }
                        if($cliente){                       
                            return $encuesta->clientes()->attach($cliente->id,[
                                'fecha_nacimiento' => $fecha ,
                                'telefono'  => $telefono,
                                'email' => $email,
                            ]);   
                        } 
                });
                 DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        }
        return response()->json('ok');
    }

    public function clientes($encuesta_id){ //CLIENTES QUE HAN SIDO ENCUESTADO POR EL MOMENTO
        //SE BUSCARAN PREGUNTADO SI EL CREATED_AT ES DISTINTO AL UPDATED
        $encuesta_clientes1 = \App\EncuestaCliente::encuesta($encuesta_id)->date()->get();
        $encuesta_clientes2 = \App\EncuestaCliente::encuesta($encuesta_id)->telefono()->get();
        $encuesta_clientes3 = \App\EncuestaCliente::encuesta($encuesta_id)->email()->get();
        $encuesta_clientes4 = \App\EncuestaCliente::encuesta($encuesta_id)->fecha_nacimiento()->get();

        $encuesta_clientes = $encuesta_clientes1->merge($encuesta_clientes2)->merge($encuesta_clientes3)->merge($encuesta_clientes4);
        $clientess = ECVResource::collection(collect($encuesta_clientes));

        // return response()->json($clientess);

       return datatables()
            ->resource($clientess)
            ->addColumn('btn','encuestas.clientes.show.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
       

    }
     public function clientesNo($encuesta_id){

        $encuesta_clientes = \App\EncuestaCliente::encuesta($encuesta_id)->telefonoN()->emailN()->fecha_nacimientoN()->get();

        $clientess = ECVExportResource::collection(collect($encuesta_clientes));

        // return response()->json($clientess);

        return datatables()
            ->resource($clientess)
             ->addColumn('btn','encuestas.clientes.show.acciones')
            ->rawColumns(['btn'])
            ->toJson();     
       

    }
    public function iniciar($id){
        $encuesta = \App\Encuesta::findOrFail($id);
        if($encuesta->termino == null){
            $encuesta->inicio = Carbon::today();
        }
        else{
            $encuesta->termino = null;
        }        
        $encuesta->save();
        return response()->json('ok');
    }
    public function terminar($id){
        $encuesta = \App\Encuesta::findOrFail($id);
        $encuesta->termino = Carbon::today();
        $encuesta->save();
        return response()->json('ok');
    }

     public function exportEncuestaCliente($encuesta_id) {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);

        $encuesta_clientes1 = \App\EncuestaCliente::encuesta($encuesta_id)->date()->get();
        $encuesta_clientes2 = \App\EncuestaCliente::encuesta($encuesta_id)->telefono()->get();
        $encuesta_clientes3 = \App\EncuestaCliente::encuesta($encuesta_id)->email()->get();
        $encuesta_clientes4 = \App\EncuestaCliente::encuesta($encuesta_id)->fecha_nacimiento()->get();

        $encuesta_clientes = $encuesta_clientes1->merge($encuesta_clientes2)->merge($encuesta_clientes3)->merge($encuesta_clientes4);

        if($encuesta_clientes->count() > 0){

            (new FastExcel($encuesta_clientes))->export(storage_path('file.xls'), function ($cliente)  {
                    $clienteC = \App\Cliente::find($cliente['cliente_id']);
                    $return['Codigo'] = $clienteC->codigo;
                    $return['Razon Social']= $clienteC->razon_social;
                    $return['Rut'] = $clienteC->rut;
                    $return['Dv'] = $clienteC->dv;
                    $return['Direccion'] = $clienteC->codigo;
                    $return['Comuna'] = $clienteC->comuna->nombre;
                    $return['fecha_nacimiento'] = $cliente->fecha_nacimiento;
                    $return['Telefono'] = $cliente->telefono;
                    $return['Email'] = $cliente->email;
               return $return;
            });
            return response()->json('ok');
        }
        else{
            return response()->json('fail');
        }

       

        
    }

}
