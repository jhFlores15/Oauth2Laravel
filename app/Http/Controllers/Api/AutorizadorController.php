<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Encuestas_Carozzi\Http\Resources\Autorizador as AutorizadorResource;
use Validator;

class AutorizadorController extends Controller
{
    public function index(){
    	$autorizadores = \Encuestas_Carozzi\Autorizador::all();
    	return response()->json($autorizadores);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'=>'required|max:255|string|unique:autorizadores',  
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $autorizador = new \Encuestas_Carozzi\Autorizador();
        $autorizador->nombre = $request->get('nombre');
        $autorizador->save();
        return response()->json('ok');
    }

    public function show($id)
    {
         $autorizador = \Encuestas_Carozzi\Autorizador::findOrFail($id);
         return response()->json($autorizador);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre'=>'required|max:255|string|unique:autorizadores,nombre,'.$id, 
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

       $autorizador=\Encuestas_Carozzi\Autorizador::findOrFail($id);
       $autorizador->nombre = $request->get('nombre');
        $autorizador->save();

       return response()->json('ok');
    }

    public function destroy($id)
    {
        $autorizador = \Encuestas_Carozzi\Autorizador::findOrFail($id);
        $autorizador->delete();
        return response()->json('ok');
    }
     public function indexAdmin()
    {
        $autorizadores = AutorizadorResource::collection(\Encuestas_Carozzi\Autorizador::all());

       // $regiones = \Encuestas_Carozzi\Region::all();
         return datatables()
            ->resource($autorizadores)
            ->addColumn('btn','autorizadores.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }
}
