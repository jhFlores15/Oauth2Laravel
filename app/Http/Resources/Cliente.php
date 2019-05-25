<?php

namespace App\Http\Resources;
use Carbon\Carbon;

use Illuminate\Http\Resources\Json\JsonResource;

class Cliente extends JsonResource
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
         return[
            'id' => $this->id,
            'codigo' => $this->codigo,
            'razon_social' => $this->razon_social,            
            'rut' => $this->rut,
            'dv' => $this->dv,
            'vendedor' => \App\User::find($this->user_id)->codigo,
            'comuna' => \App\Comuna::find($this->comuna_id)->nombre,
            'direccion' => $this->direccion, 
        ];
    }
}
