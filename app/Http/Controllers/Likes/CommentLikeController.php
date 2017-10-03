<?php

namespace App\Http\Controllers\Likes;

use Auth;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentLikeController extends Controller
{
    public function add(Request $request){
    	//check if request has detailId, if no response with error
	    if (!$request->has('commentId'))
	        return response()->json(
	            ['message'=>'parameters not required'], 422
	        );
	    //getting detail by id or response error
		$comment = Comment::findOrFail($request->commentId);
		//getting user like to current detail
		$like = $comment->likes()
	            ->where('user_id', Auth::user()->id)
	            ->first();
	    //if like doesnt exists create new
	    if ($like == null){
	        $like = new Like;
	        $like->state = true;
	        $like->user_id = Auth::user()->id;
	        $comment->likes()->save($like);
	    }//edit current like
	    else
	    	Like::where('id', $like->id)
	    		->update(['state' => !($like->state)]);
	    //return response with active likes count
	    return response()->json(['count' => $comment->activeLikes()->count()], 200);
    }
}
