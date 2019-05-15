<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function index()
    {
        return view('encuestas.index.index');
    }
     public function create()
    {
        return view('encuestas.create');
    }
    public function index_vendedor(){
        return view('encuestas.index_vendedor.index');
    }
    public function edit($id){
        
        $encuesta = \App\Encuesta::findOrFail($id);

        $marcas = $encuesta->marcas;
        foreach ($marcas as $marca) {
            if(count($marca->clientes) > 0){
                abort(404);
            }           
        }
        return view('encuestas.existencia.edit' , ['encuesta_id' => $id]);
    }
}
