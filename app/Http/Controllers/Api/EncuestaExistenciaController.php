<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteVend as ClienteVendResource;
use App\Http\Resources\EncuestaExistencia as EncuestaExistenciaResource;
use App\Encuesta;
use App\Cliente;
use Validator;

class EncuestaExistenciaController extends Controller
{
    public function index_encuestados($encuesta_id) 
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->groupBy('cliente_id');
        
        $ids = [];
        foreach ($marcas as $marca) {
            $cliente =  \App\Cliente::find($marca[0]->cliente_id);
            if($cliente->user_id == auth()->user()->id){
                $id = new \stdClass();
                $id->id = $marca[0]->cliente_id;
                $id->encuesta_id = $encuesta_id;
                $ids [] = $id;
            }            
         }         
         $clientes = ClienteVendResource::collection(collect($ids)); //Encuestados del vendedor
          $encuesta = \App\Encuesta::findOrFail($encuesta_id);
          $clientes->map(function($cliente) use($encuesta){
            $cliente->encuesta_id = $encuesta;
        });

        return datatables()
            ->resource($clientes)
             ->addColumn('btn','encuestas.existencia.vendedor.accionesY')
            ->rawColumns(['btn'])
            ->toJson();    
    }
    public function index_no_encuestados($encuesta_id) //Vendedor listado de clientes para vendedor
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->groupBy('cliente_id');
        $idsss = [];
        foreach ($marcas as $marca) {           
            $idsss [] = $marca[0]->cliente_id;
         }
         $clientes = ClienteVendResource::collection(collect(Cliente::all()->where('user_id','=', auth()->user()->id)->whereNotIn('id', $idsss))); //No Encuestados
          $encuesta = \App\Encuesta::findOrFail($encuesta_id);
         $clientes->map(function($cliente) use($encuesta){
            $cliente->encuesta_id = $encuesta;
        });

         return datatables()
            ->resource($clientes)
            ->addColumn('btn','encuestas.existencia.vendedor.accionesN')
            ->rawColumns(['btn'])
            ->toJson();    
    }

    public function store(Request $request) //Vendedor
    {
         $validator = Validator::make($request->all(), [
            'cliente_id'=>'required|exists:clientes,id',          
            'encuesta_id'=>'required|exists:encuestas,id',
            'marca_id'=>'required|exists:marcas,id',
            'valor'=>'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $marca_id = $request->get('marca_id');
        $valor = $request->get('valor');
        $cliente_id = $request->get('cliente_id');

        $cliente = \App\Cliente::findOrFail($cliente_id);
        if(auth()->user()->id != $cliente->user_id){ 
            abort(401);
        }
        $marca = \App\Marca::findOrFail($marca_id);
        $marca->clientes()->attach($cliente_id,['valor' => $valor ]);  

        return response()->json('ok'); 

    }

   
    public function update(Request $request, $id) //Vendedor
    {
         $validator = Validator::make($request->all(), [
            'valor'=>'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }        
        $valor = $request->get('valor');
        $cliente_marca = \App\ClienteMarca::findOrFail($id);
        $cliente = \App\Cliente::findOrFail($cliente_marca->cliente_id);
        if(auth()->user()->id != $cliente->user_id){ 
            abort(401);
        }
        $cliente_marca->valor = $valor;
        $cliente_marca->save();        

        return response()->json('ok'); 
    }


    public function edit($id){
        $encuesta = Encuesta::findOrFail($id);
        $encuesta = EncuestaExistenciaResource::collection(Encuesta::all()->where('id',$id)); 
        return response()->json($encuesta);
    }
}
