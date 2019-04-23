<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Rol as RolResource;

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
            'rol' => \App\Rol::find($this->rol_id),
            'password_visible' => $this->password_visible,
        ];
    }
}
