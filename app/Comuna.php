<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
	protected $table = 'comunas';
    protected $fillable = ['nombre'];

    public function region(){
    	return $this->belongsto('Encuestas_Carozzi\Region');
    }
     public function clientes(){
    	return $this->hasMany('Encuestas_Carozzi\Cliente');
    }
}
