<?php

namespace Encuestas_Carozzi\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Marca extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return[
            'id' => $this->id,
            'nombre' => $this->nombre,
            'tipo_producto' => \Encuestas_Carozzi\Tipo_Producto::find($this->tipo_producto_id),
            'categoria' => \Encuestas_Carozzi\Categoria::find($this->categoria_id),  
        ];
    }
}
