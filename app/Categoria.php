<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $table = 'categorias';
      public function marcas(){
    	return $this->hasMany('Encuestas_Carozzi\Marca');
    }
}
