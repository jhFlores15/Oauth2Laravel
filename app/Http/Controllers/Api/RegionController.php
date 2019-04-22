<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regiones = \App\Region::all();
        return response()->json($regiones); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $region = new \App\Region();
        $region->nombre = $request->get('nombre');
        $region->nombre = $request->get('numero');
        $region->save();
        retunr response()->json($region);
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
        $validatedData = $request->validate([
            'name'=>'required|max:255|string|unique:regiones,nombre,'.$id,            
            'name'=>'required|integer|unique:regiones,numero,'.$id,
        ]);
       $region=\App\Region::findOrFail($id)->update($request->all());
       return response()->json($region);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = App\Region::findOrFail($id);
        $region->delete();
        return 'ok';
    }
}
