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
            'razon_social' => $this->razon_social,
            'codigo' => $this->codigo,
            'rut' => $this->rut,
            'dv' => $this->dv,
            'direccion' => $this->direccion,
            'localidad' => \App\Localidad::find($this->localidad_id),
            'vendedor' => \App\User::find($this->user_id),
            'created_at' => ($this->created_at)->format('d-m-Y'),
            'updated_at' => ($this->updated_at)->format('d-m-Y'),
        ];
    }
}
