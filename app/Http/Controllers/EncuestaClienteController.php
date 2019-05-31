<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Resources\Encuesta as EncuestaResource;
use Carbon\Carbon;
use DateTime;

class EncuestaClienteController extends Controller
{
    public function show($id){
    	$encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($id);
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


        $encuesta_clientes1 = \Encuestas_Carozzi\EncuestaCliente::encuesta($id)->date()->get();
        $encuesta_clientes2 = \Encuestas_Carozzi\EncuestaCliente::encuesta($id)->telefono()->get();
        $encuesta_clientes3 = \Encuestas_Carozzi\EncuestaCliente::encuesta($id)->email()->get();
        $encuesta_clientes4 = \Encuestas_Carozzi\EncuestaCliente::encuesta($id)->fecha_nacimiento()->get();

        $encuesta_clientes = $encuesta_clientes1->merge($encuesta_clientes2)->merge($encuesta_clientes3)->merge($encuesta_clientes4);



        $clientesCount = count($encuesta_clientes);
        $clientesCount2 = \Encuestas_Carozzi\EncuestaCliente::encuesta($encuesta->id)->count();
        $encuesta->{"registros"}= $clientesCount;
        $encuesta->{"total"}= $clientesCount2;
    	return view('encuestas.clientes.show.show',  ['encuesta' => $encuesta]); 
    }
    public function edit(){

    }
}
