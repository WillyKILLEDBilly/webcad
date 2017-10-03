<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sculpt extends Model
{
    protected $table = 'sculpts';

    public function parameterValues(){
    	return $this->hasMany('App\Models\SculptParameterValue');
    }
}
