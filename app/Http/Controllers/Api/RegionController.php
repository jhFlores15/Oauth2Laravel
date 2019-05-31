<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Validator;
use Encuestas_Carozzi\Http\Resources\Region as RegionResource;
use Encuestas_Carozzi\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regiones = RegionResource::collection(Region::all());

       // $regiones = \Encuestas_Carozzi\Region::all();
         return datatables()
            ->resource($regiones)
            ->addColumn('btn','regiones.acciones')
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
         $validator = Validator::make($request->all(), [
            'nombre'=>'required|max:255|string|unique:regiones',            
            'numero'=>'required|unique:regiones',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $region = new \Encuestas_Carozzi\Region();
        $region->nombre = $request->get('nombre');
        $region->numero = $request->get('numero');
        $region->save();

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
        $region = \Encuestas_Carozzi\Region::findOrFail($id);
        return response()->json($region);
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
            'nombre'=>'required|max:255|string|unique:regiones,nombre,'.$id,            
            'numero'=>'required|integer|unique:regiones,numero,'.$id,
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

       $region=\Encuestas_Carozzi\Region::findOrFail($id)->update($request->all());

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
        $region = \Encuestas_Carozzi\Region::findOrFail($id);
        $region->delete();
        return 'ok';
    }
}
