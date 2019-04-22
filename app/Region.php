<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name','description'];

    public function comunas(){
    	return->$this->hasMany('App\Comuna');
    }
}
