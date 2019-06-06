<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Validator;

class NotaCreditoController extends Controller
{
     public function store(Request $request) //Vendedor
    {
        $validator = Validator::make($request->all(), [
            'cliente_id'=>'nullable|numeric',          
            'cliente_name'=>'nullable|string',
            'autorizador_id'=>'required|exists:autorizadores,id',
            'factura' => 'required|numeric',
            'descripcion' =>'required|string',
            'cantidad' => 'nullable|string',
            'detalle' => 'required|string',
            'monto' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $vendedor = auth()->user();
        $autorizador = \Encuestas_Carozzi\Autorizador::find($request->get('autorizador_id'));
        $nota = new \Encuestas_Carozzi\Nota_Credito();
        $nota->user()->associate($vendedor);
        $nota->autorizadores()->associate($autorizador);
        $nota->cliente_id = $request->get('cliente_id');
        $nota->cliente_name = $request->get('cliente_name');
        $nota->factura = $request->get('factura');
        $nota->descripcion = $request->get('descripcion');
        $nota->cantidad = $request->get('cantidad');
        $nota->detalle = $request->get('detalle');
        $nota->monto = $request->get('monto');       
        $nota->save();
        return response()->json($nota); 
    }
    public function update(Request $request, $id) //Vendedor
    {
        $validator = Validator::make($request->all(), [
            'cliente_id'=>'nullable|numeric',          
            'cliente_name'=>'nullable|string',
            'autorizador_id'=>'required|exists:autorizadores,id',
            'factura' => 'required|numeric',
            'descripcion' =>'required|string',
            'cantidad' => 'nullable|string',
            'detalle' => 'required|string',
            'monto' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $nota = \Encuestas_Carozzi\Nota_Credito::findOrFail($id);
        if(auth()->user()->id != $nota->user_id){ 
            abort(401);
        }      
        
        if($nota->autorizadores_id != $request->get('autorizador_id')){
            $autorizador = \Encuestas_Carozzi\Autorizador::find($request->get('autorizador_id'));
            $nota->autorizadores()->dissociate();
            $nota->autorizadores()->associate($autorizador);

        }        
        $nota->cliente_id = $request->get('cliente_id');
        $nota->cliente_name = $request->get('cliente_name');
        $nota->factura = $request->get('factura');
        $nota->descripcion = $request->get('descripcion');
        $nota->cantidad = $request->get('cantidad');
        $nota->detalle = $request->get('detalle');
        $nota->monto = $request->get('monto');       
        $nota->save();
        return response()->json('ok'); 
    }
}
