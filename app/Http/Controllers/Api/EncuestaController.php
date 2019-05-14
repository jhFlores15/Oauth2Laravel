<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Resources\Encuesta as EncuestaResource;
use App\Encuesta;


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
    public function store(Request $request)
    {
       

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
    public function destroy($id)
    {
        //
    }
}
