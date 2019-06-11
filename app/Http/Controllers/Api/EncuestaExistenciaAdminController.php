<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Encuestas_Carozzi\Http\Resources\Cliente as ClienteResource;
use Encuestas_Carozzi\Http\Resources\ClienteVend as ClienteVendResource;
use Encuestas_Carozzi\Http\Resources\EncuestaMarcaCliente as EncuestaMarcaClienteResource;
use Rap2hpoutre\FastExcel\FastExcel;

use Encuestas_Carozzi\Cliente;

class EncuestaExistenciaAdminController extends Controller
{
    public function index_no_encuestados($encuesta_id) //Vendedor listado de clientes para vendedor
    {
        $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->groupBy('cliente_id');
        $idsss = [];
        foreach ($marcas as $marca) {           
            $idsss [] = $marca[0]->cliente_id;
         }
         $clientes = ClienteResource::collection(collect(Cliente::all()->whereNotIn('id', $idsss)->take(10)));     
         return datatables()
            ->resource($clientes)
            ->toJson();    
    }
    public function index_encuestados($encuesta_id) 
    {
        $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        $clientes = $encuesta->marca_cliente->groupBy('cliente_id')->take(10);
        $clientes = EncuestaMarcaClienteResource::collection(collect($clientes));

        return datatables()
            ->resource($clientes)
            ->toJson();    
    }
    public function exportEncuestaExistencia($encuesta_id) {
        $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        $valores = $encuesta->marca_cliente->groupBy('cliente_id');
        $marcas = $encuesta->marcas;
        $categorias = $marcas->groupBy('categoria_id'); 
        if(count($valores) == 0){
            return response()->json('fail');
        }
        
        (new FastExcel($valores))->export(storage_path('file.xls'), function ($valores) use($encuesta,$marcas) {

                $cliente_id; 
                   foreach ($marcas as $marca) {
                    $bool = false;
                         foreach ($valores as $value) {                        
                            $cliente_id = $value->cliente_id;
                            if($value->marca_id == $marca->id){
                                 $return[$marca->nombre] = $value->valor;    
                                $bool = true;
                            }                                           
                        }
                        if($bool == false){
                            if($encuesta->tipo_encuesta_id == 1){
                                $return[$marca->nombre] = 2; 
                            }
                            else if($encuesta->tipo_encuesta_id == 3){
                                $return[$marca->nombre] = -1; 
                            }
                        }
                   }
                $cliente = \Encuestas_Carozzi\Cliente::find($cliente_id);
                $return['Codigo'] = $cliente->codigo;
                $return['Razon Social']= $cliente->razon_social;
                $return['Rut'] = $cliente->rut;
                $return['Dv'] = $cliente->dv;
                $return['Direccion'] = $cliente->direccion;
                $return['Comuna'] = $cliente->comuna->nombre;
                $return['Vendedor'] = $cliente->user->codigo;
           return $return;
        });

        return response()->json('ok');
    }
     public function exportEncuestaNoExistencia($encuesta_id) {
       $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->groupBy('cliente_id');
        $idsss = [];
        foreach ($marcas as $marca) {           
            $idsss [] = $marca[0]->cliente_id;
         }
         $clientes = (Cliente::all()->whereNotIn('id', $idsss));
        if(count($clientes) == 0){
            return response()->json('fail');
        }
        
         (new FastExcel($clientes))->export(storage_path('file.xls'), function ($cliente) {
                $return['Codigo'] = $cliente->codigo;
                $return['Razon Social']= $cliente->razon_social;
                $return['Rut'] = $cliente->rut;
                $return['Dv'] = $cliente->dv;
                $return['Direccion'] = $cliente->direccion;
                $return['Comuna'] = $cliente->comuna->nombre;
                $return['Vendedor'] = $cliente->user->codigo;
            return $return;
        });
        return response()->json('ok');
    }
}
