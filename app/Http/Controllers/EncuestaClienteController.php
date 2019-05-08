<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Encuesta as EncuestaResource;
use Carbon\Carbon;
use DateTime;

class EncuestaClienteController extends Controller
{
    public function show($id){
    	$encuesta = \App\Encuesta::findOrFail($id);
    	$encuesta->tipo_encuesta;
    	 $empezo = (new DateTime($encuesta->inicio))->diff(new DateTime())->format('%R');
        $termino="";$m="";$n="";
        if($encuesta->inicio){
            $m = Carbon::parse($encuesta->inicio)->format('d-m-Y');
        }
        if($encuesta->termino){
            $n = Carbon::parse($encuesta->termino)->format('d-m-Y');
            $termino = (new DateTime($encuesta->termino))->diff(new DateTime())->format('%R');
        }   
        $estado = '';
         if($empezo == '-'){
             $estado = 'Inactivo';
        }
        if($termino == '+'){
            $estado = 'Finalizado';
        }
        if($empezo == '+' && $termino == '-'){
            $estado = 'En Proceso';
        }
        if($empezo == '+' && $termino == ''){
            $estado = 'En Proceso';
        }
        $encuesta->{"estado"}= $estado;
        $clientesCount = \App\EncuestaCliente::date()->encuesta($encuesta->id)->count();
        $clientesCount2 = \App\EncuestaCliente::encuesta($encuesta->id)->count();
        $encuesta->{"registros"}= $clientesCount;
        $encuesta->{"total"}= $clientesCount2;
    	return view('encuestas.clientes.show.show',  ['encuesta' => $encuesta]); 
    }
    public function edit(){

    }
}
