<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class MarcaController extends Controller
{
     public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'tipo_producto_id'=>'required|exists:tipos_productos,id',
            'categoria_id'=>'required|exists:categorias,id',            
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $marca = \App\Marca::findOrFail($id);
        $marca->nombre = $request->get('nombre');        

        if($marca->tipo_producto_id !== $request->get('tipo_producto_id')){
            $marca->tipo_producto()->dissociate();
            $tipo_producto = \App\Tipo_Producto::findOrFail($request->get('tipo_producto_id'));
            $marca->tipo_producto()->associate($tipo_producto);
        }
        if($marca->categoria_id !== $request->get('categoria_id')){
            $marca->categoria()->dissociate();
            $categoria = \App\Categoria::findOrFail($request->get('categoria_id'));
            $marca->categoria()->associate($categoria);       
    	}
    	$marca->save();
       
        return response()->json('ok');
    }
     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'tipo_producto_id'=>'required|exists:tipos_productos,id',
            'categoria_id'=>'required|exists:categorias,id',
            'encuesta_id' => 'required|exists:encuestas,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $marca = new \App\Marca();
        $marca->nombre = $request->get('nombre');
        $marca->encuesta_id = $request->get('encuesta_id');
        $tipo_producto = \App\Tipo_Producto::findOrFail($request->get('tipo_producto_id'));
        $marca->tipo_producto()->associate($tipo_producto);
        $categoria = \App\Categoria::findOrFail($request->get('categoria_id'));
        $marca->categoria()->associate($categoria);  
    	$marca->save();
       
        return response()->json('ok');
    }
     public function destroy($id)
    {
        $marca = \App\Marca::findOrFail($id); 
        $categoria = \App\Categoria::findOrFail($marca->categoria_id);  
        $marcas = $categoria->marcas;
        if($marcas->count() > 1)  {
        	$marca->delete();
        	return response()->json('ok');
        } 
        else{
        	return response()->json('Categoria debe tener como minimo 1 producto/marca');
        }  
    }
    public function show($encuesta_id){
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marcas;
        return response()->json($marcas);
    }
}
