<?php

namespace Encuestas_Carozzi\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Encuestas_Carozzi\Http\Resources\Marca as MarcaResource;

class EncuestaExistencia extends JsonResource
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
            'marcas' => MarcaResource::collection($this->marcas)->groupBy('categoria.id'),    
        ];
    }
}
