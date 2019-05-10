<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteMarca extends Model
{
	public $incrementing = true;
    protected $table = 'clientes_marcas';
  //   public function clientes (){

		// return $this->belongsToMany('App\Cliente','encuesta_cliente','encuesta_id','cliente_id')->using('App\EncuestaCliente')->withTimestamps()->withPivot(['fecha_nacimiento','telefono','email']);
  //   }
}
