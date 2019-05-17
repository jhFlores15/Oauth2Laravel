<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\ClienteVend as ClienteVendResource;
use App\Http\Resources\EncuestaMarcaCliente as EncuestaMarcaClienteResource;

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
            // ->addColumn('btn','encuestas.existencia.acciones')
            // ->rawColumns(['btn'])
            ->toJson();    
    }
    public function index_encuestados($encuesta_id) 
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $clientes = $encuesta->marca_cliente->groupBy('cliente_id');        
             
        $clientes = EncuestaMarcaClienteResource::collection(collect($clientes));
         
        //return response()->json($clientes);

        return datatables()
            ->resource($clientes)
            //  ->addColumn('btn','encuestas.existencia.acciones')
            // ->rawColumns(['btn'])
            ->toJson();    
    }
}
