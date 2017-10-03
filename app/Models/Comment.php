<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function commentable(){
    	return $this->morphTo();
    }

    public function childs(){
    	return $this->hasMany('App\Models\Comment', 'parent_id');
    }

    public function likes(){
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function activeLikes(){
        return $this->likes()->where('state','=',true);
    }
}