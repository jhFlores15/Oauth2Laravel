<?php

namespace Encuestas_Carozzi;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	protected $table = 'roles';
    protected $fillable = ['name'];

    public function users(){
    	return $this->hasMany('Encuestas_Carozzi\User');
    }
}
