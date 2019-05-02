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

		return belongsToMany('App\Cliente','encuesta_cliente','encuesta_id','cliente_id')->using('App\Encuesta_Cliente')->withTimestamps()->withPivot(['cumpleaños','telefono','email']);
    }


}
