<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Encuesta extends Model
{
    protected $table = 'tipo_encuesta';
    protected $fillable = ['nombre','descripcion'];

    public function encuestas(){
    	return $this->hasMany('App\Encuesta');
    }
}
