<?php

namespace App\Http\Controllers\Likes;

use Auth;
use App\Models\Like;
use App\Models\Detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailLikeController extends Controller
{
    public function add(Request $request){
	    //check if request has detailId, if no response with error
	    if (!$request->has('detailId'))
	        return response()->json(
	            ['message'=>'parameters not required'], 422
	        );
	    //getting detail by id or response error
		$detail = Detail::findOrFail($request->detailId);
		//getting user like to current detail
		$like = $detail->likes()
	            ->where('user_id', Auth::user()->id)
	            ->first();
	    //if like doesnt exists create new
	    if ($like == null){
	        $like = new Like;
	        $like->state = true;
	        $like->user_id = Auth::user()->id;
	        $detail->likes()->save($like);
	    }//edit current like
	    else
	    	Like::where('id', $like->id)
	    		->update(['state' => !($like->state)]);
	    //return response with active likes count
	    return response()->json(['count' => $detail->activeLikes()->count()], 200);
    }
}