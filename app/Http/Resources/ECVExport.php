<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ECVExport extends JsonResource
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
        $comuna = \App\Comuna::find($cliente->comuna_id);
        $vendedor = \App\User::find($cliente->user_id);
       
         return[  
            'codigo' => $cliente->codigo,        
            'razon_social' => $cliente->razon_social,
            'rut' => $cliente->rut,
            'dv' => $cliente->dv,
            'vendedor' => $vendedor->codigo,
            'direccion' => $cliente->direccion,
            'comuna' => $comuna->nombre,
            
        ];
    }
}
