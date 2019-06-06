<?php

namespace Encuestas_Carozzi\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Nota_Credito extends JsonResource
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
            'cliente_id' => $this->cliente_id,
            'cliente_name' => $this->cliente_name,
            'factura' => $this->factura,
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad,
            'detalle' => $this->detalle,
            'monto' => $this->monto,
            'autoriza' => \Encuestas_Carozzi\Autorizador::find($this->autorizadores_id),
            'user' => \Encuestas_Carozzi\User::find($this->user_id),
        ];
    }
}
