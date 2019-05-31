<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Encuestas_Carozzi\Encuesta;
use Encuestas_Carozzi\Cliente;
use Validator;

class EncuestaPrecioController extends Controller
{
	 public function store(Request $request) //Vendedor
    {
         $validator = Validator::make($request->all(), [
            'cliente_id'=>'required|exists:clientes,id',          
            'encuesta_id'=>'required|exists:encuestas,id',
            'marca_id'=>'required|exists:marcas,id',
            'valor'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $marca_id = $request->get('marca_id');
        $valor = $request->get('valor');
        $cliente_id = $request->get('cliente_id');
         $cliente = \Encuestas_Carozzi\Cliente::findOrFail($cliente_id);
        if(auth()->user()->id != $cliente->user_id){ 
            abort(401);
        }
        $existe = \Encuestas_Carozzi\ClienteMarca::all()->where('cliente_id',$cliente_id)->where('marca_id',$marca_id)->count();
        if($existe > 0){ 
            abort(401);
        }
        $marca = \Encuestas_Carozzi\Marca::findOrFail($marca_id);
        $marca->clientes()->attach($cliente_id,['valor' => $valor ]);  

        return response()->json('ok'); 

    }
   public function update(Request $request, $id) //Vendedor
    {
         $validator = Validator::make($request->all(), [
            'valor'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        
        $valor = $request->get('valor');

        $cliente_marca = \Encuestas_Carozzi\ClienteMarca::findOrFail($id);
        $cliente = \Encuestas_Carozzi\Cliente::findOrFail($cliente_marca->cliente_id);
        if(auth()->user()->id != $cliente->user_id){ 
            abort(401);
        }
        $cliente_marca->valor = $valor;
        $cliente_marca->save();        

        return response()->json('ok'); 
    }
}
