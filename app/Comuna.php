<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
	protected $table = 'comunas';
    protected $fillable = ['nombre'];

    public function region(){
    	return $this->belongsto('App\Region');
    }
     public function localidades(){
    	return $this->hasMany('App\Localidad');
    }
}
