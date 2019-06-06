<?php

namespace Encuestas_Carozzi\Http\Controllers\Api;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Controllers\Controller;
use Validator;
use Encuestas_Carozzi\Http\Resources\Nota_Credito as Nota_CreditoResource;
use Rap2hpoutre\FastExcel\FastExcel;

class NotaCreditoController extends Controller
{
    public function show($id){
         $nota = \Encuestas_Carozzi\Nota_Credito::findOrFail($id);
         return response()->json($nota);
    }
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
        return response()->json('ok'); 
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
      public function indexVendedor()
    {
        $user = auth()->user();
        $notas = Nota_CreditoResource::collection(\Encuestas_Carozzi\Nota_Credito::all()->where('user_id',$user->id));
      

     return datatables()
         ->resource($notas)
        ->addColumn('btn','notas_credito.vendedor.index.acciones')
        ->rawColumns(['btn'])
        ->toJson();

    }
    public function indexAdmin()
    {     
        $notas = Nota_CreditoResource::collection(\Encuestas_Carozzi\Nota_Credito::all());
        return datatables()
            ->resource($notas)
            ->addColumn('btn','')
            ->rawColumns(['btn'])
            ->toJson();

    }
     public function exportNotas(Request $request) {
        $data = $request->toArray();
        if(count($data) == 0){
            return response()->json('fail');
        }
        $ids=[];
        foreach ($data as $dat) {
            $ids [] = $dat['id'];
           
        }
        $notas = \Encuestas_Carozzi\Nota_Credito::all()->whereIn('id', $ids);

        (new FastExcel($notas))->export(storage_path('file.xls'), function ($dat) {
            $autorizador = \Encuestas_Carozzi\Autorizador::find($dat->autorizadores_id);
            return[
                'cod_cliente' => $dat->cliente_id,
                'cliente' => $dat->cliente_name,
                'factura' => $dat->factura,
                'descripcion' => $dat->descripcion,
                'cantidad' => $dat->cantidad,
                'detalle' => $dat->detalle,
                'monto' => $dat->monto,
                'autoriza' => $autorizador->nombre,
                'vendedor' => $dat->user_id,
            ];
        });

        return response()->json('ok');
    }
    public function destroy(Request $request) {
        $data = $request->toArray();
        if(count($data) == 0){
            return response()->json('fail');
        }
        $ids=[];
        foreach ($data as $dat) {
            \Encuestas_Carozzi\Nota_Credito::findOrFail($dat['id'])->delete();
           
        }
        return response()->json('ok');
    }
}
