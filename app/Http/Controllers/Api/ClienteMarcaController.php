<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;

class ClienteMarcaController extends Controller
{
    public function index($cliente_id, $encuesta_id){ //listado de registros del cliente
    	$encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->where('cliente_id','=',$cliente_id);
        return response()->json($marcas);
    }
    public function show($cliente_id, $marca_id){ // litsado de un una sola marca_cliente

    	$cliente_marca = \Encuestas_Carozzi\ClienteMarca::all()->where('cliente_id','=',$cliente_id)->where('marca_id','=',$marca_id)->first();

    	return response()->json($cliente_marca);
    }
}
