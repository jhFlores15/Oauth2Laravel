<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cliente extends Model
{
    

	protected $table = 'clientes';

    protected $fillable = [
        'razon_social', 'direccion','rut','dv','codigo','localidad_id','vendedor_id',
    ];

    public function user(){
    	return $this->belongsto('Encuestas_Carozzi\User');
    }

    public function comuna(){
    	return $this->belongsto('Encuestas_Carozzi\Comuna');
    }
     public function encuestas (){
        return belongsToMany('Encuestas_Carozzi\Encuesta','encuesta_cliente','cliente_id','encuesta_id')->using('Encuestas_Carozzi\Encuesta_Cliente')->withTimestamps()->withPivot(['fecha_nacimiento','telefono','email']);
    }
    public function scopeUpdatedd($query)
    {
        return $query->whereDate('updated_at', '!=', Carbon::today());
    }
}
