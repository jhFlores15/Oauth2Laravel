<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
     public function store(Request $request)
    {
        $productos = $request->get('marcas');
        $encuesta_id = $request->get('encuesta_id');
        DB::beginTransaction();         
        try {        
            $categoria = new \Encuestas_Carozzi\Categoria();
            $categoria->nombre = $request->get('nombre');
            $categoria->save();
            foreach ($productos as $marcaT) {
                $marca = new \Encuestas_Carozzi\Marca();
                $marca->categoria_id = $categoria->id;
                $marca->encuesta_id = $encuesta_id;
                $marca->nombre = $marcaT['nombre'];
                $marca->tipo_producto_id = $marcaT['tipo'];
                $marca->save();                       
            }       
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }       
        return response()->json('ok');
    }
   
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $categoria = \Encuestas_Carozzi\Categoria::findOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->save();
       
        return response()->json('ok');
    }
    public function destroy($id)
    { 
        $categoria = \Encuestas_Carozzi\Categoria::findOrFail($id);  
         DB::beginTransaction();         
        try {   
            $categoria->marcas()->delete();
            $categoria->delete();
         DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }       
        return response()->json('ok');
    }
}
