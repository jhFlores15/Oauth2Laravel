<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteVend extends JsonResource
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
         $cliente = \App\Cliente::find($this->id);         
          return[
            'id' => $cliente->id,
            'encuesta_id' => $this->encuesta_id,
            'codigo' => $cliente->codigo,
            'razon_social' => $cliente->razon_social,         
            'direccion' => $cliente->direccion,
            'comuna' => \App\Comuna::find($cliente->comuna_id),
        ];
    }
}
