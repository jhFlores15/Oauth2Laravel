<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = \App\Localidad::all();
        return response()->json($localidades); 
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
            'nombre'=>'required|max:255|string|unique:localidades',            
            'comuna_id'=>'required|exists:comunas,id',
            'codigo' => 'required|numeric|unique:localidades',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $localidad = new \App\Localidad();
        $localidad->nombre = $request->get('nombre');
        $localidad->codigo = $request->get('codigo');

        $comuna = \App\Region::findOrFail($request->get('comuna_id'));
        $localidad->comuna()->associate($comuna);

        $localidad->save();
        return response()->json($localidad);
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
            'nombre'=>'required|max:255|string|unique:localidades,nombre,'.$id,  
            'codigo'=>'required|numeric|unique:localidades,codigo,'.$id,              
            'comuna_id'=>'required|exists:comunas,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

       $localidad=\App\Localidad::findOrFail($id)->update($request->all());
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
        $localidad = \App\Localidad::findOrFail($id);
        $localidad->delete();
        return 'ok';
    }
}
