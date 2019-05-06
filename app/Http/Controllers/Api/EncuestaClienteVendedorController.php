<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\ECV as ECVResource;

class EncuestaClienteVendedorController extends Controller
{ ///////////DEL LADO DEL VENDEDOR
    //encuestar - editar encuesta 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($encuesta_id) 
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        if($encuesta->tipo_encuesta_id == 2){ // si es encuesta cliente
            $clientes = \App\EncuestaCliente::all()->where('encuesta_id','=',$encuesta_id);
            $clientes = ECVResource::collection($clientes);
        }
        else{
            $clientes = ClienteResource::collection(Cliente::where('user_id','=',$vendedor->id)); //PARA LOS OTROS TIPOS 
        }
        $vendedor = Auth::user();

         return datatables()
            ->resource($clientes)
            ->addColumn('btn','encuestas.clientes.index.acciones')
            ->rawColumns(['btn'])
            ->toJson();    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request,$encuesta_id,$cliente_id)
   {
        $validator = Validator::make($request->all(), [
            'cumpleaños' => 'nullable|string',
            'telefono'    => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $encuesta_cl = \App\EncuestaCliente::encuesta($encuesta_id)->cliente($cliente_id)->take(1)->get();
        $encuesta_cl = \App\EncuestaCliente::find($encuesta_cl[0]['id']);
        if($encuesta_cl){
            if($request->get('cumpleaños')){
                $encuesta_cl->cumpleaños = $request->get('cumpleaños');
            }
             if($request->get('telefono')){
                $encuesta_cl->telefono = $request->get('telefono');
            }
             if($request->get('email')){
                $encuesta_cl->email = $request->get('email');
            }   
                     
            $encuesta_cl->save();
        }
        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($encuesta_id,$cliente_id) // ver encuesta cliente en especifico
    {
        $encuesta_cli = \App\EncuestaCliente::encuesta($encuesta_id)->cliente($cliente_id)->take(1)->get();
        return response()->json($encuesta_cli);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
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
