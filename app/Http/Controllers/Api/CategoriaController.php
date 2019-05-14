<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CategoriaController extends Controller
{
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $categoria = \App\Categoria::findOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->save();
       
        return response()->json('ok');
    }
    public function destroy($id)
    { 
        $categoria = \App\Categoria::findOrFail($id);  
        $categoria->marcas()->delete();
        $categoria->delete();
        return response()->json('ok');
    }
}
