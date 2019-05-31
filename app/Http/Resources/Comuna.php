<?php

namespace Encuestas_Carozzi\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comuna extends JsonResource
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
            'region' => \Encuestas_Carozzi\Region::find($this->region_id),
            'nombre' => $this->nombre,           
        ];

    }
}
