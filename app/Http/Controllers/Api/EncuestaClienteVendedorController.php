<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
use Encuestas_Carozzi\Http\Resources\Cliente as ClienteResource;
use Encuestas_Carozzi\Http\Resources\ECV as ECVResource;
use Encuestas_Carozzi\Cliente;

class EncuestaClienteVendedorController extends Controller
{ ///////////DEL LADO DEL VENDEDOR

    public function index($encuesta_id) 
    {
        $vendedor = Auth::user();
        $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        if($encuesta->tipo_encuesta_id == 2){ // si es encuesta cliente
            $encuesta_clientes = \Encuestas_Carozzi\EncuestaCliente::all()->where('encuesta_id','=',$encuesta_id);            
            $encuesta_cli = [];
            foreach ($encuesta_clientes as $e_cli) {
                $cliente = \Encuestas_Carozzi\Cliente::findOrFail($e_cli->cliente_id);
                if($cliente->user_id == $vendedor->id){
                    $encuesta_cli [] = $e_cli;
                }            

            }
            $clientess = ECVResource::collection(collect($encuesta_cli));
            // dd($clientess);

        }

         return datatables()
            ->resource($clientess)
            ->addColumn('btn','encuestas.clientes.index.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
        
    }


   public function update(Request $request,$encuesta_id,$cliente_id)
   {
        $validator = Validator::make($request->all(), [
            'fecha_nacimiento' => 'nullable|date|before_or_equal:18 years ago',
            'telefono'    => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $cliente = \Encuestas_Carozzi\Cliente::findOrFail($cliente_id);
        if(auth()->user()->id != $cliente->user_id){ //solo actualiza el vendedor que tenga ese cliente
            abort(401);
        }

        $encuesta_cl = \Encuestas_Carozzi\EncuestaCliente::encuesta($encuesta_id)->cliente($cliente_id)->take(1)->get();
        $encuesta_cl = \Encuestas_Carozzi\EncuestaCliente::find($encuesta_cl[0]['id']);
        if($encuesta_cl){
                $encuesta_cl->fecha_nacimiento = $request->get('fecha_nacimiento');
                $encuesta_cl->telefono = $request->get('telefono');
                $encuesta_cl->email = $request->get('email');
                     
            $encuesta_cl->save();
        }
        return response()->json('ok');
    }

    public function show($encuesta_id,$cliente_id) // ver encuesta cliente en especifico
    {
        $cliente = \Encuestas_Carozzi\Cliente::findOrFail($cliente_id);
        if(auth()->user()->id != $cliente->user_id){ 
            abort(401);
        }
        $encuesta_cli = \Encuestas_Carozzi\EncuestaCliente::encuesta($encuesta_id)->cliente($cliente_id)->take(1)->get();
        return response()->json($encuesta_cli);
    }

}
