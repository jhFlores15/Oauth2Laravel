<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $fillable = ['name','description'];

    public function region(){
    	return->$this->belongsto('App\Region');
    }
}
