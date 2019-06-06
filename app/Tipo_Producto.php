<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Tipo_Producto extends Model
{
    protected $table = 'tipos_productos';
    protected $fillable = ['nombre'];

    public function marcas(){
    	return $this->hasMany('Encuestas_Carozzi\Marca');
    }
     public function getCreatedAtAttribute($value)
    {
         return '';
    }
}
