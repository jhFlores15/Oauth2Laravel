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

}
