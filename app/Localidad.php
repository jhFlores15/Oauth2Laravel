<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    protected $fillable = ['nombre','codigo'];

    public function comuna(){
    	return $this->belongsto('Encuestas_Carozzi\Comuna');
    }
    
}
