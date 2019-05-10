<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $fillable = ['descripcion','inicio','termino'];

    public function tipo_encuesta(){
    	return $this->belongsto('App\Tipo_Encuesta');
    }
    public function clientes (){

		return $this->belongsToMany('App\Cliente','encuesta_cliente','encuesta_id','cliente_id')->using('App\EncuestaCliente')->withTimestamps()->withPivot(['fecha_nacimiento','telefono','email']);
    }


    public function scopeInicio($query){
    	return $query->whereDate('inicio', '<=', Carbon::today());
    }
    public function scopeTerminoo($query){
    	return $query->where('termino', '=', null);
    }
    public function scopeTermino($query){
    	return $query->where('termino', '>', Carbon::today());
    }
    


}
