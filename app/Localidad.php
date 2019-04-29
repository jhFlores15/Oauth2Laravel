<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    protected $fillable = ['nombre','codigo'];

    public function comuna(){
    	return $this->belongsto('App\Comuna');
    }
    
}
