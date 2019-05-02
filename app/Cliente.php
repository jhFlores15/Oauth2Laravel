<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    

	protected $table = 'clientes';

    protected $fillable = [
        'razon_social', 'direccion','rut','dv','codigo','localidad_id','vendedor_id',
    ];

    public function user(){
    	return $this->belongsto('App\User');
    }

    public function localidad(){
    	return $this->belongsto('App\Localidad');
    }
     public function encuestas (){
        return belongsToMany('App\Encuesta','encuesta_cliente','cliente_id','encuesta_id')->using('App\Encuesta_Cliente')->withTimestamps()->withPivot(['cumpleaños','telefono','email']);
    }

}
