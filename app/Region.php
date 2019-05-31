<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	protected $table = 'regiones';
    protected $fillable = ['nombre','numero'];

    public function comunas(){
    	return $this->hasMany('Encuestas_Carozzi\Comuna');
    }
}
