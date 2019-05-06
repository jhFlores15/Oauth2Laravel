<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $fillable = ['descripcion','inicio','termino'];

    public function tipo_encuesta(){
    	return $this->belongsto('App\Tipo_Encuesta');
    }
    public function clientes (){

		return $this->belongsToMany('App\Cliente','encuesta_cliente','encuesta_id','cliente_id')->using('App\EncuestaCliente')->withTimestamps()->withPivot(['cumpleaños','telefono','email']);
    }


}
