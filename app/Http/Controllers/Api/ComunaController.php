<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Resources\Comuna as ComunaResource;
use App\Comuna;

class ComunaController extends Controller
{

    public function index()
    {
        $comunas = ComunaResource::collection(Comuna::all());

         return datatables()
             ->resource($comunas)
            //->eloquent(ComunaResource::collection(Comuna::all()))
            ->addColumn('btn','comunas.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'=>'required|max:255|string|unique:comunas',            
            'region_id'=>'required|exists:regiones,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $comuna = new \App\Comuna();
        $comuna->nombre = $request->get('nombre');

        $region = \App\Region::findOrFail($request->get('region_id'));
        $comuna->region()->associate($region);

        $comuna->save();
        return response()->json('ok');
    }

    public function show($id)
    {
         $comuna = Comuna::findOrFail($id);
         $comuna->region;
         return response()->json($comuna);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre'=>'required|max:255|string|unique:comunas,nombre,'.$id,            
            'region_id'=>'required|exists:regiones,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

       $comuna=\App\Comuna::findOrFail($id);
       $comuna->nombre = $request->get('nombre');


        if($comuna->region_id !== $request->get('region_id')){
            $comuna->region()->dissociate();
            $region = \App\Region::findOrFail($request->get('region_id'));
            $comuna->region()->associate($region);
        }
        $comuna->save();

       return response()->json('ok');
    }

    public function destroy($id)
    {
        $comuna = \App\Comuna::findOrFail($id);
        $comuna->delete();
        return response()->json('ok');
    }
}
