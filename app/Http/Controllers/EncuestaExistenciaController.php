<?php

namespace Encuestas_Carozzi\Http\Controllers;

use Illuminate\Http\Request;
use Encuestas_Carozzi\Http\Resources\Encuesta as EncuestaResource;
use Carbon\Carbon;
use DateTime;

class EncuestaExistenciaController extends Controller
{
    public function index($encuesta_id){
        $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
        return view('encuestas.existencia.vendedor.index' , ['encuesta' => $encuesta]);
    }
    public function create ($encuesta_id,$cliente_id){ //Vendedor
         return view('encuestas.existencia.vendedor.create' , ['encuesta_id' => $encuesta_id ,'cliente_id' => $cliente_id]);
    }
    public function edit($encuesta_id,$cliente_id){ //Vendedor
        //verificar que esten todos respondidos, sino rellenar con no-- lo mismo al ver en Admin

         $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
         $marcasT = $encuesta->marcas;
         $marcasC = $encuesta->marca_cliente->where('cliente_id','=',$cliente_id);

         if(count($marcasT) != count($marcasC)){
            foreach ($marcasT as $marca) {
                $m = $encuesta->marca_cliente->where('cliente_id','=',$cliente_id)->where('marca_id','=', $marca->id);
                if(count($m) == 0){
                    $marca->clientes()->attach($cliente_id,['valor' => 2 ]);  
                }
            }
         }
         return view('encuestas.existencia.vendedor.edit' , ['encuesta_id' => $encuesta_id ,'cliente_id' => $cliente_id]);

    }
    public function show($encuesta_id){
       $encuesta = \Encuestas_Carozzi\Encuesta::findOrFail($encuesta_id);
          ////////Rellenar dartos faltantes

        $valores = $encuesta->marca_cliente->groupBy('cliente_id');
          $editable = true;
        
        $marcas = $encuesta->marcas;
        foreach ($marcas as $marca) {
            if(count($marca->clientes) > 0){
                $editable = false;
                break;
            }           
        }

         foreach ($valores as $value) {   
             foreach ($value as $val) {   
                             
                $cliente_id = $val->cliente_id;
                $marcasC = $encuesta->marca_cliente->where('cliente_id',$cliente_id);
                 if(count($marcas) != count($marcasC)){
                    foreach ($marcas as $marca) {
                        $m = $encuesta->marca_cliente->where('cliente_id',$cliente_id)->where('marca_id','=', $marca->id);
                        if(count($m) == 0){
                            $marca->clientes()->attach($cliente_id,['valor' => 2 ]);  
                        }
                    }
                 } 
            }                
        } 
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

         $encuestados = $encuesta->marca_cliente->groupBy('cliente_id');
         $encuesta->{"registros"}= $encuestados->count();

         $total = \Encuestas_Carozzi\Cliente::all()->count();
        $encuesta->{"total"}= $total;

        $editable = true;
        
        $marcas = $encuesta->marcas;
        foreach ($marcas as $marca) {
            if(count($marca->clientes) > 0){
                $editable = false;
                break;
            }           
        }
        $encuesta->{"editableEliminable"}= $editable;
        //categorias y sus productos
        $categorias = $marcas->groupBy('categoria_id'); 
        $encuesta->{"marcasCount"}= $encuesta->marcas->count();       


       
        return view('encuestas.existencia.show' , ['encuesta' => $encuesta , 'categorias' => $categorias]);

    }
     public function excelDownload(){
        return response()->download(storage_path('file.xls'))->deleteFileAfterSend(true);
    }
}
