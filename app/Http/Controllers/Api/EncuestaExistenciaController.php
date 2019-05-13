<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Resources\EncuestaExistencia as EncuestaExistenciaResource;
use App\Encuesta;

class EncuestaExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string|unique:encuestas',            
            'tipo_encuesta'=>'required|exists:tipo_encuesta,id',
            'fecha_inicio' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $categorias = $request->get('categorias');       
        $encuesta = new \App\Encuesta();
        $encuesta->descripcion = $request->get('descripcion');
        $encuesta->inicio = $request->get('fecha_inicio');
        $tipo_encuesta = \App\Tipo_Encuesta::findOrFail($request->get('tipo_encuesta'));
        $encuesta->tipo_encuesta()->associate($tipo_encuesta);
        //$encuesta->save();

    
        DB::beginTransaction();
         
        try {
            $encuesta->save();
           foreach ($categorias as $categoria ) {
                $categoriaN = new \App\Categoria();
                $categoriaN->nombre =  $categoria['nombre'];
                $categoriaN->save(); 
                foreach ($categoria['productos'] as $marcaT) {
                    $marca = new \App\Marca();
                    $marca->categoria_id = $categoriaN->id;
                    $marca->encuesta_id = $encuesta->id;
                    $marca->nombre = $marcaT['nombre'];
                    $marca->tipo_producto_id = $marcaT['tipo'];
                    $marca->save();                       
                }          
            }         
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        return response()->json($encuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        $encuesta = EncuestaExistenciaResource::collection(Encuesta::all()->where('id',$id)); 
        return response()->json($encuesta);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
