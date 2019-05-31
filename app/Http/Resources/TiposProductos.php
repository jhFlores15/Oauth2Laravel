<?php

namespace Encuestas_Carozzi\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TiposProductos extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
