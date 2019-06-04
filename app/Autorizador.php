<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Autorizador extends Model
{
	protected $table = 'autorizadores';
     public function notas_credito(){
        return $this->hasMany('Encuestas_Carozzi\Nota_Credito');
    }
}
