<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cliente as ClienteResource;
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
            ->addColumn('btn','encuestas.existencia.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
    }
    public function index_encuestados($encuesta_id) 
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->groupBy('cliente_id');
        
        $ids = [];
        foreach ($marcas as $marca) {
            $cliente =  \App\Cliente::find($marca[0]->cliente_id);
            if($cliente->user_id == auth()->user()->id){
                $id = new \stdClass();
                $id->id = $marca[0]->cliente_id;
                $id->encuesta_id = $encuesta_id;
                $ids [] = $id;
            }            
         }         
         $clientes = ClienteVendResource::collection(collect($ids)); //Encuestados del vendedor
          $encuesta = \App\Encuesta::findOrFail($encuesta_id);
          $clientes->map(function($cliente) use($encuesta){
            $cliente->encuesta_id = $encuesta;
        });

        return datatables()
            ->resource($clientes)
             ->addColumn('btn','encuestas.existencia.vendedor.accionesY')
            ->rawColumns(['btn'])
            ->toJson();    
    }
}
