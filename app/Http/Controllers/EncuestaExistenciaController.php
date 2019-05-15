<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaExistenciaController extends Controller
{
    // public function edit($id){

    // 	//Si no hay ninguno encuestado

    // 	$encuesta = \App\Encuesta::findOrFail($id);

    // 	$marcas = $encuesta->marcas;
    // 	foreach ($marcas as $marca) {
    // 		if(count($marca->clientes) > 0){
    // 			abort(404);
    // 		}    		
    // 	}
    // 	return view('encuestas.existencia.edit' , ['encuesta_id' => $id]);
    // }
}
