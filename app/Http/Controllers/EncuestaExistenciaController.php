<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaExistenciaController extends Controller
{
    public function index($encuesta_id){
        $encuesta = \App\Encuesta::findOrFail($encuesta_id);
        return view('encuestas.existencia.vendedor.index' , ['encuesta' => $encuesta]);
    }
    public function create ($id){ //Vendedor

       
    	
    }
    public function edit($id){ //Vendedor

        return view('encuestas.existencia.edit' , ['encuesta_id' => $id]);

    }
}
