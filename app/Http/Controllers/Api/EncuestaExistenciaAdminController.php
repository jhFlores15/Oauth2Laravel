<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\ClienteVend as ClienteVendResource;
use App\Http\Resources\EncuestaMarcaCliente as EncuestaMarcaClienteResource;
use Rap2hpoutre\FastExcel\FastExcel;

use App\Cliente;

class EncuestaExistenciaAdminController extends Controller
{
    public function index_no_encuestados($encuesta_id) //Vendedor listado de clientes para vendedor
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->groupBy('cliente_id');
        $idsss = [];
        foreach ($marcas as $marca) {           
            $idsss [] = $marca[0]->cliente_id;
         }
         $clientes = ClienteResource::collection(collect(Cliente::all()->whereNotIn('id', $idsss)));     
         return datatables()
            ->resource($clientes)
            ->toJson();    
    }
    public function index_encuestados($encuesta_id) 
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $clientes = $encuesta->marca_cliente->groupBy('cliente_id');        
             
        $clientes = EncuestaMarcaClienteResource::collection(collect($clientes));

        return datatables()
            ->resource($clientes)
            ->toJson();    
    }
    public function exportEncuestaExistencia($encuesta_id) {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $valores = $encuesta->marca_cliente->groupBy('cliente_id');
        $marcas = $encuesta->marcas;
        $categorias = $marcas->groupBy('categoria_id'); 
        if(count($valores) == 0){
            return response()->json('fail');
        }
        
        (new FastExcel($valores))->export(storage_path('file.xls'), function ($valores) use($categorias,$encuesta, $marcas) {

                $cliente_id;             
                 foreach ($valores as $value) {                        
                    $cliente_id = $value->cliente_id;
                  
                    $return[\App\Marca::find($value->marca_id)->nombre] = $value->valor;                    
                }
                $cliente = \App\Cliente::find($cliente_id);
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
}
