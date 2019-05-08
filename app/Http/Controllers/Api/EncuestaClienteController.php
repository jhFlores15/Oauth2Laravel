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
use App\Encuesta;

class EncuestaClienteController extends Controller
{  
    //////////////DEL LADO DEL ADMINISTRADOR

    //generar reporte- eliminarla- iniciarla y terminarla-verla-editarla con respecto a Encuesta Cliente
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //clientes que han sido encuestados
    {


        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string|unique:encuestas',            
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
    public function file (Request $request, $encuesta_id){
         $validator = Validator::make($request->all(), [
            'csv' => 'required|file'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
      

        if($request->hasFile('csv')){
            $csv = $request->file('csv');
            $encuesta_clientes = (new FastExcel)->import($csv, function ($line) use ($encuesta){
                $cliente = \App\Cliente::all()->where('codigo','=',$line['codigo'])->first();
                    if($cliente){                       
                        return $encuesta->clientes()->attach($cliente->id);   
                    } 
            });
        }
        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function clientes($encuesta_id){ //CLIENTES QUE HAN SIDO ENCUESTADO POR EL MOMENTO
        //SE BUSCARAN PREGUNTADO SI EL CREATED_AT ES DISTINTO AL UPDATED
        $encuesta_clientes = \App\EncuestaCliente::encuesta($encuesta_id)->date()->get();

        $clientess = ECVResource::collection(collect($encuesta_clientes));

        // return response()->json($clientess);

       return datatables()
            ->resource($clientess)
            ->addColumn('btn','encuestas.clientes.show.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
       

    }
     public function clientesNo($encuesta_id){ //CLIENTES QUE HAN SIDO ENCUESTADO POR EL MOMENTO
        //SE BUSCARAN PREGUNTADO SI EL CREATED_AT ES DISTINTO AL UPDATED
        $encuesta_clientes = \App\EncuestaCliente::encuesta($encuesta_id)->dateEq()->get();

        $clientess = ECVResource::collection(collect($encuesta_clientes));

        // return response()->json($clientess);

       return datatables()
            ->resource($clientess)
            ->addColumn('btn','encuestas.clientes.show.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
       

    }


    public function show($encuesta_id) //Ver Encuesta - reporte
    {
        //tipo de Encuesta aunque sea obvio
        //clientes encuestado por el momento del total
        //vendedor de cada cliente
        //erght
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $encuesta_completa = EncuestaResource::collection($encuesta); 

        return response()->json($encuesta_completa);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string|unique:encuestas,descripcion,'.$id,           
            'tipo_encuesta'=>'required|exists:tipo_encuesta,id',
            'fecha_inicio' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $encuesta = \App\Encuesta::findOrFail($id);
        if($encuesta){
            $empezo = (new DateTime($this->inicio))->diff(new DateTime())->format('%R');
            //$termino = (new DateTime($this->termino))->diff(new DateTime())->format('%R');
            if($empezo == '-'){ // es porque esta Inactivo, por lo que puede ser editado y eliminado                
                $encuesta->descripcion = $request->get('descripcion');
                $encuesta->inicio = $request->get('fecha_inicio');
                if($comuna->region_id !== $request->get('tipo_encuesta')){
                    $comuna->tipo_encuesta()->dissociate();
                    $tipo_encuesta = \App\Region::findOrFail($request->get('region_id'));
                    $encuesta->tipo_encuesta()->associate($tipo_encuesta);
                }
                $encuesta->save();
                return response()->json('ok');
            }
            else{
                return response()->json('fail');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encuesta = \App\Encuesta::findOrFail($id);
        if($encuesta){
            $empezo = (new DateTime($this->inicio))->diff(new DateTime())->format('%R');
            //$termino = (new DateTime($this->termino))->diff(new DateTime())->format('%R');
            if($empezo == '-'){ // es porque esta Inactivo, por lo que puede ser editado y eliminado
                 $encuesta->delete();
                 return response()->json('ok');
            }
            else{
                return response()->json('fail');
            }
        }
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

}
