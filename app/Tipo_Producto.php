<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Producto extends Model
{
    protected $table = 'tipos_productos';
    protected $fillable = ['nombre'];

    public function marcas(){
    	return $this->hasMany('App\Marca');
    }
}
