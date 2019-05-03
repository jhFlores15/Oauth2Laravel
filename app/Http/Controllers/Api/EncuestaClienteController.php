<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class EncuestaClienteController extends Controller
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
        $encuesta = new \App\Encuesta();
        $encuesta->descripcion = $request->get('descripcion');
        $encuesta->inicio = $request->get('fecha_inicio');
        $tipo_encuesta = \App\Tipo_Encuesta::findOrFail($request->get('tipo_encuesta'));
        $encuesta->tipo_encuesta()->associate($tipo_encuesta);
        $encuesta->save();
        
        return response()->json($encuesta);
    }
    public function file (Request $request, $encuesta_id){
         $validator = Validator::make($request->all(), [
            'csv' => 'required|file'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $csv = $request->file('csv');

        if($request->hasFile('csv')){

            $encuesta_clientes = (new FastExcel)->import($csv, function ($line) use ($encuesta){
                $cliente = \App\Cliente::all()->where('codigo','=',$line['codigo'])->first();
                    if($cliente){
                       
                        return $encuesta->clientes()->attach($cliente->id);   
                    }                
           
               
            });
        }
        return response()->json('ok');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
