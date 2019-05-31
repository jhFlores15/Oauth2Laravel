<?php

namespace Encuestas_Carozzi\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EncuestaMarcaCliente extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = [];
        $marca = \Encuestas_Carozzi\Marca::find($this[0]->marca_id);
        $encuesta = \Encuestas_Carozzi\Encuesta::find($marca->encuesta_id);
        $marcas = $encuesta->marcas;
        $categorias = $marcas->groupBy('categoria_id');  

        foreach ($categorias as $categoria){
            foreach ($categoria as $prod){
                foreach ($this as $value) {
                     foreach ($value as $val) {
                         if($prod->id == $val->marca_id){
                            $val->categoria = $categoria;
                            $array [] = $val;
                        }
                    }
                }
            }
        }
        $cliente = \Encuestas_Carozzi\Cliente::find($this[0]->cliente_id);

        return[
            'id' => $this[0]->cliente_id,
            'codigo' => $cliente->codigo,
            'valores' => $array,
            'rut' => $cliente->rut,
            'dv' => $cliente->dv,
            'razon_social' => $cliente->razon_social,
            'comuna' => \Encuestas_Carozzi\Comuna::find($cliente->comuna_id),
            'direccion' => $cliente->direccion,
            'vendedor' => \Encuestas_Carozzi\User::find($cliente->user_id),
        ];
    }
}
