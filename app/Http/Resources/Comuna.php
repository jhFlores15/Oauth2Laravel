<?php

namespace App\Http\Resources;

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
            'region' => \App\Region::find($this->region_id),
            'nombre' => $this->nombre,           
        ];

    }
}
