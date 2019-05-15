<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Resources\Encuesta as EncuestaResource;
use App\Http\Resources\EncuestaExistencia as EncuestaExistenciaResource;
use App\Encuesta;
use Illuminate\Support\Facades\DB;


class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encuestas = EncuestaResource::collection(Encuesta::all()); //Listado de encuestas Para el  Administrador

        return datatables()
            ->resource($encuestas)
            ->addColumn('btn','encuestas.index.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function index_vendedor()
    {
        $encuestas = Encuesta::inicio()->termino()->get();
        $encuestas2 = Encuesta::inicio()->terminoo()->get();
        $encuestas_c = $encuestas->merge($encuestas2);
        $encuestas_c = EncuestaResource::collection($encuestas_c); 
        //Listado de encuestas Para el  VENDEDOR

        return datatables()
            ->resource($encuestas_c)
            ->addColumn('btn','encuestas.index_vendedor.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) /// para existencia y precio
    {
          $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string',            
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
        $encuesta = \App\Encuesta::findOrFail($id);
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
         $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string',  
            'fecha_inicio' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $encuesta = \App\Encuesta::findOrFail($id);                
        $encuesta->descripcion = $request->get('descripcion');
        $encuesta->inicio = $request->get('fecha_inicio');               
        $encuesta->save();
        return response()->json('ok');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Existencia -Precio
    {
        $encuesta = \App\Encuesta::findOrFail($id);
        DB::beginTransaction();         
        try {
            $marcas = $encuesta->marcas;
            foreach ($marcas as $marca) {
               $categoria = \App\Categoria::find($marca->categoria_id);
               if($categoria){
                    $categoria->marcas()->delete();
                    $categoria->delete();
                }                
            }
            $encuesta->delete();
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
