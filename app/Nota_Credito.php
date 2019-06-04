<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Nota_Credito extends Model
{
    protected $table = 'notas_credito';
    public function vendedor(){
    	return $this->belongsto('Encuestas_Carozzi\User');
    }
    public function autorizador(){
    	return $this->belongsto('Encuestas_Carozzi\Autorizador');
    }
}
