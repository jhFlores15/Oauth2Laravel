<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaClienteVendedorController extends Controller
{
	//hacer encuesta  y editarla SOLA
    // listar clientes para encuestar GLOBAL


            
   public function edit($encuesta_id,$cliente_id){
   	 return view('encuestas.clientes.edit' , ['encuesta_id' => $encuesta_id, 'cliente_id' => $cliente_id]);   	
    }
    public function index($encuesta_id){
    	$encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
    	return view('encuestas.clientes.index.index' ,  ['encuesta' => $encuesta]); 
    }
   
}
