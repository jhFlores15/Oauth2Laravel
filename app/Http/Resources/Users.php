<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Users extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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
            'rol' => $this->RolesResource::collection($this->rol_id),
            'password_visible' => $this->password_visible,
        ];
    }
}
