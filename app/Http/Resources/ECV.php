<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ECV extends JsonResource
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
        $cliente = \App\Cliente::findOrFail($this->cliente_id);
        $encuestado = 'Encuestar';
        $cumpleaños ="";
        if($this->cumpleaños || $this->telefono || $this->email ){
            $encuestado = 'Editar Encuesta';
        }
        if($this->cumpleaños){
            $cumpleaños = Carbon::parse($this->cumpleaños)->format('d-m-Y');
        }
         return[          
            'id' => $cliente->id,
            'encuesta_id' => $this->encuesta_id,
            'razon_social' => $cliente->razon_social,
            'codigo' => $cliente->codigo,
            'rut' => $cliente->rut,
            'dv' => $cliente->dv,
            'encuesta' => $encuestado,
            'direccion' => $cliente->direccion,
            'localidad' => \App\Localidad::find($cliente->localidad_id),
            'vendedor' => \App\User::find($cliente->user_id),
            'created_at' => ($cliente->created_at)->format('d-m-Y'),
            'updated_at' => ($cliente->updated_at)->format('d-m-Y'),
            'cumpleaños' =>  $cumpleaños,
            'telefono' => $this->telefono,
            'email' => $this->email,

        ];
    }
}
