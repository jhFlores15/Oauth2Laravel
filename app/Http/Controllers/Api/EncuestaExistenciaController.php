<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteVend as ClienteVendResource;
use App\Encuesta;
use App\Cliente;

class EncuestaExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return datatables()
            ->resource($clientes)
             ->addColumn('btn','encuestas.existencia.vendedor.acciones',$encuesta_id)
            ->rawColumns(['btn'])
            ->toJson();    
    }
    public function index_no_encuestados($encuesta_id) //Vendedor listado de clientes para vendedor
    {
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        $marcas = $encuesta->marca_cliente->groupBy('cliente_id');
        
        $ids = [];
        $idsss = [];
        foreach ($marcas as $marca) {           
            $idsss [] = $marca[0]->cliente_id;
         }
         $clientes = ClienteVendResource::collection(collect(Cliente::all()->where('user_id','=', auth()->user()->id)->whereNotIn('id', $idsss))); //No Encuestados
         $clientes->map(function($cliente) use($encuesta_id){
            $cliente->encuesta_id = $encuesta_id;
        });

         return datatables()
            ->resource($clientes)
            ->addColumn('btn','encuestas.existencia.vendedor.acciones',$encuesta_id)
            ->rawColumns(['btn'])
            ->toJson();    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //Vendedor
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Ver Admin
    {
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //Vendedor
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
    public function edit($id){
        $encuesta = Encuesta::findOrFail($id);
        $encuesta = EncuestaExistenciaResource::collection(Encuesta::all()->where('id',$id)); 
        return response()->json($encuesta);
    }
}
