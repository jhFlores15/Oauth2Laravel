<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Validator;
use Encuestas_Carozzi\Http\Resources\Comuna as ComunaResource;
use Encuestas_Carozzi\Comuna;

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

        $comuna = new \Encuestas_Carozzi\Comuna();
        $comuna->nombre = $request->get('nombre');

        $region = \Encuestas_Carozzi\Region::findOrFail($request->get('region_id'));
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

       $comuna=\Encuestas_Carozzi\Comuna::findOrFail($id);
       $comuna->nombre = $request->get('nombre');


        if($comuna->region_id !== $request->get('region_id')){
            $comuna->region()->dissociate();
            $region = \Encuestas_Carozzi\Region::findOrFail($request->get('region_id'));
            $comuna->region()->associate($region);
        }
        $comuna->save();

       return response()->json('ok');
    }

    public function destroy($id)
    {
        $comuna = \Encuestas_Carozzi\Comuna::findOrFail($id);
        $comuna->delete();
        return response()->json('ok');
    }
}
