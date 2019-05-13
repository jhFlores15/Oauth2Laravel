<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaExistenciaController extends Controller
{
    public function edit($id){
    	return view('encuestas.existencia.edit' , ['encuesta_id' => $id]);
    }
}
