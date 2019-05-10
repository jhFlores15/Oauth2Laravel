<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
      public function marcas(){
    	return $this->hasMany('App\Marca');
    }
}
