<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaExistenciaController extends Controller
{
    public function index($encuesta_id){
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        return view('encuestas.existencia.vendedor.index' , ['encuesta' => $encuesta]);
    }
    public function create ($encuesta_id,$cliente_id){ //Vendedor
         return view('encuestas.existencia.vendedor.create' , ['encuesta_id' => $encuesta_id ,'cliente_id' => $cliente_id]);
    }
    public function edit($encuesta_id,$cliente_id){ //Vendedor
        //verificar que esten todos respondidos, sino rellenar con no-- lo mismo al ver en Admin

         $encuesta = \App\Encuesta::findOrFail($encuesta_id);
         $marcasT = $encuesta->marcas;
         $marcasC = $encuesta->marca_cliente->where('cliente_id','=',$cliente_id);


         if(count($marcasT) != count($marcasC)){
            foreach ($marcasT as $marca) {
                $m = $encuesta->marca_cliente->where('cliente_id','=',$cliente_id)->where('marca_id','=', $marca->id);
                if(count($m) == 0){
                    $marca->clientes()->attach($cliente_id,['valor' => 0 ]);  
                }
            }
         }
         return view('encuestas.existencia.vendedor.edit' , ['encuesta_id' => $encuesta_id ,'cliente_id' => $cliente_id]);

    }
}
