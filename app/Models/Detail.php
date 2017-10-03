<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'details';

    public function parameterTypes(){
    	return $this->belongsToMany('App\Models\ParameterType', 'detail_has_parameter_type');
    }

    public function category(){
        return $this->belongsTo('App\Models\DetailCategory', 'detail_category_id' );
    }

    public function sculpts(){
    	return $this->hasMany('App\Models\Sculpt');
    }

    public function views(){
    	return $this->hasMany('App\Models\DetailView');
    }

    public function likes(){
    	return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function activeLikes(){
        return $this->likes()->where('state','=',true);
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'detail_has_tag');
    }
}