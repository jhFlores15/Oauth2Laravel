<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Http\Resources\Cliente as ClienteResource;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function activos(Request $request){ //data completa para actualizar y crear nuevos clientes POST
        $validator = Validator::make($request->all(), [
            'archivo_activos' => 'required|file'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
         DB::beginTransaction();             
            try {
                if($request->hasFile('archivo_activos')){
                    $file = $request->file('archivo_activos');
                    (new FastExcel)->import($file, function ($line){
                         if($line['codigo'] != ''){
                            $cliente = new \App\Cliente();
                            $cliente->codigo = trim($line['codigo']);
                            $cliente->rut = trim(\str_replace ( ".", "", $line['rut']));
                            $cliente->dv =trim($line['dv']);
                            $cliente->razon_social = $line['razon_social'];
                            $cliente->direccion = $line['direccion'];
                            $comuna = \App\Comuna::all()->where('nombre','=',trim($line['comuna']))->first();
                            if($comuna){
                                $cliente->comuna_id = $comuna->id;
                            }
                            else{
                                $comuna = \App\Comuna::all()->where('nombre','No Tiene')->first();
                                $cliente->comuna_id = $comuna->id;
                            }
                            $vendedor = \App\User::all()->where('codigo','=',trim($line['cod_vendedor']))->first();
                            $cliente->user_id = $vendedor->id;
                            $cliente->save();
                        } 
                        return ;
                    });
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        return response()->json('ok');
    }


    public function exportActivos(){
        $clientes = \App\Cliente::all()->count();      
        if($clientes == 0){
            return response()->json('fail');
        }    
           (new FastExcel((\App\Cliente::all())))->export(storage_path('file.xls'), function ($cliente) {
                $return['Codigo'] = $cliente->codigo;
                $return['Razon Social']= $cliente->razon_social;
                $return['Rut'] = $cliente->rut;
                $return['Dv'] = $cliente->dv;
                $return['Direccion'] = $cliente->codigo;
                $return['Comuna'] = $cliente->comuna->nombre;
                $return['Vendedor'] = $cliente->user->codigo;
            return $return;
        });
        return response()->json('ok');
    }

    public function show($id)
    {
         $cliente = cliente::findOrFail($id);
         $cliente->comuna;
         $cliente->user;
         return response()->json($cliente);
    }
        public function destroy()
    {
        \App\ClienteMarca::whereNotNull('id')->delete();
        \App\Marca::whereNotNull('id')->delete();
        \App\EncuestaCliente::whereNotNull('id')->delete();
        \App\Categoria::whereNotNull('id')->delete();
        \App\Cliente::whereNotNull('id')->delete();
        \App\Encuesta::whereNotNull('id')->delete();

        return response()->json('ok');
    }
   
   
    // public function index()
    // {
    //     $clientes = ClienteResource::collection(Cliente::all());

    //      return datatables()
    //         ->resource($clientes)
    //         ->addColumn('btn','clientes.acciones')
    //         ->rawColumns(['btn'])
    //         ->toJson();    
    // }
  
 







    // public function file(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'file' => 'required|file'
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['error'=>$validator->errors()], 422);
    //     }

    //     if($request->hasFile('file')){

    //         //   DB::beginTransaction();
             
    //         // try {

    //         $file = $request->file('file');
    //         $clientes = (new FastExcel)->import($file, function ($line) {
    //             if($line['codigo'] != ''){
    //                 $cliente = \App\Cliente::all()->where('codigo','=',trim($line['codigo']))->first();
    //                 if($cliente){ //actualizar
    //                     $vendedor = \App\User::all()->where('codigo','=',trim($line['cod_vendedor']))->first();
    //                     $cliente->user_id = $vendedor->id;
    //                     $cliente->save();
    //                 }
    //                 else{ 
    //                     $cliente = new \App\Cliente();
    //                     $cliente->codigo = trim($line['codigo']);
    //                     $cliente->rut = trim(\str_replace ( ".", "", $line['rut']));
    //                     $cliente->dv =trim($line['dv']);
    //                     $cliente->razon_social = $line['razon_social'];
    //                     $cliente->direccion = $line['direccion'];
    //                     if($line['comuna'] != ''){
    //                         $comuna = \App\Comuna::all()->where('nombre','=',trim($line['comuna']))->first();
    //                         $cliente->comuna_id = $comuna->id;
    //                     }  
    //                     else{
    //                         $comuna = \App\Comuna::all()->where('nombre','No Tiene')->first();
    //                         $cliente->comuna_id = $comuna->id;
    //                     }
    //                     $vendedor = \App\User::all()->where('codigo','=',trim($line['cod_vendedor']))->first();
    //                     $cliente->user_id = $vendedor->id;
    //                     $cliente->save();
    //                 } 
    //             }
    //             return ;
    //         });

    //         $clientes_eliminar = \App\Cliente::updatedd()->orderBy('codigo')->get();

    //         $arrays = ($clientes_eliminar->modelKeys());
    //          \App\Cliente::destroy($arrays);


    //         // DB::commit();
    //         // } catch (\Exception $e) {
    //         //     DB::rollback();
    //         //     throw $e;
    //         // }
    //         // catch (\Throwable $e) {
    //         //     DB::rollback();
    //         //     throw $e;
    //         // }
           
    //     }
    //     return response()->json('ok');
    // }

}
