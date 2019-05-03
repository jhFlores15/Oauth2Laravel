<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use DateTime;

class EncuestaClienteController extends Controller
{

    //generar reporte- eliminarla- iniciarla y terminarla-verla-editarla con respecto a Encuesta Cliente
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
      

        if($request->hasFile('csv')){
            $csv = $request->file('csv');
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
         $validator = Validator::make($request->all(), [
            'descripcion'=>'required|max:255|string|unique:encuestas,descripcion,'.$id,           
            'tipo_encuesta'=>'required|exists:tipo_encuesta,id',
            'fecha_inicio' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $encuesta = \App\Encuesta::findOrFail($id);
        if($encuesta){
            $empezo = (new DateTime($this->inicio))->diff(new DateTime())->format('%R');
            //$termino = (new DateTime($this->termino))->diff(new DateTime())->format('%R');
            if($empezo == '-'){ // es porque esta Inactivo, por lo que puede ser editado y eliminado                
                $encuesta->descripcion = $request->get('descripcion');
                $encuesta->inicio = $request->get('fecha_inicio');
                if($comuna->region_id !== $request->get('tipo_encuesta')){
                    $comuna->tipo_encuesta()->dissociate();
                    $tipo_encuesta = \App\Region::findOrFail($request->get('region_id'));
                    $encuesta->tipo_encuesta()->associate($tipo_encuesta);
                }
                $encuesta->save();
                return response()->json('ok');
            }
            else{
                return response()->json('fail');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encuesta = \App\Encuesta::findOrFail($id);
        if($encuesta){
            $empezo = (new DateTime($this->inicio))->diff(new DateTime())->format('%R');
            //$termino = (new DateTime($this->termino))->diff(new DateTime())->format('%R');
            if($empezo == '-'){ // es porque esta Inactivo, por lo que puede ser editado y eliminado
                 $encuesta->delete();
                 return response()->json('ok');
            }
            else{
                return response()->json('fail');
            }
        }
    }
    public function iniciar($id){
        $encuesta = \App\Encuesta::findOrFail($id);
        $encuesta->inicio = Carbon::today()
        $encuesta->save();
    }
    ´public function terminar($id){
        $encuesta = \App\Encuesta::findOrFail($id);
        $encuesta->termino = Carbon::today()
        $encuesta->save();
    }
}
