<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use DateTime;

class Encuesta extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
            $empezo = (new DateTime($this->inicio))->diff(new DateTime())->format('%R');
            $termino="";$m="";$n="";
            if($this->inicio){
                $m = Carbon::parse($this->inicio)->format('d-m-Y');
            }
            if($this->termino){
                $n = Carbon::parse($this->termino)->format('d-m-Y');
                $termino = (new DateTime($this->termino))->diff(new DateTime())->format('%R');
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
          return[
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'inicio' => $m,
            'termino' => $n,
            'tipo_encuesta'=> \App\Tipo_Encuesta::findOrFail($this->tipo_encuesta_id),
            'created_at' => ($this->created_at)->format('d-m-Y'),
            'updated_at' => ($this->updated_at)->format('d-m-Y'), 
            'estado' =>   $estado,       
        ];
    }
}
