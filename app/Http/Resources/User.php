<?php

namespace Encuestas_Carozzi\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Encuestas_Carozzi\Http\Resources\Rol as RolResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'razon_social' => $this->razon_social,
            'codigo' => $this->codigo,
            'rut' => $this->rut,
            'dv' => $this->dv,
            'email' => $this->email,
            'password_visible' => $this->password_visible,
        ];
    }
}
