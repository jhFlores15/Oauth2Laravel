<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Validator;

class NotaCreditoController extends Controller
{
     public function store(Request $request) //Vendedor
    {
        //  $validator = Validator::make($request->all(), [
        //     'cliente_id'=>'numeric',          
        //     'cliente_name'=>'string,id',
        //     'marca_id'=>'required|exists:marcas,id',
        //     'valor'=>'required|boolean',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()], 422);
        // }
        // $marca_id = $request->get('marca_id');
        // $valor = $request->get('valor');
        // $cliente_id = $request->get('cliente_id');

        // $cliente = \Encuestas_Carozzi\Cliente::findOrFail($cliente_id);
        // if(auth()->user()->id != $cliente->user_id){ 
        //     abort(401);
        // }
        //  $existe = \Encuestas_Carozzi\ClienteMarca::all()->where('cliente_id',$cliente_id)->where('marca_id',$marca_id)->count();
        // if($existe > 0){ 
        //     abort(401);
        // }
        // $marca = \Encuestas_Carozzi\Marca::findOrFail($marca_id);
        // $marca->clientes()->attach($cliente_id,['valor' => $valor ]);  

        // return response()->json('ok'); 

    }
}
