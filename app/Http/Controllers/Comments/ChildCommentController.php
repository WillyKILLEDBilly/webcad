<?php

namespace App\Http\Controllers\Comments;

use Auth;
use App\Models\Detail;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChildCommentController extends Controller
{
	public function add(Request $request){
		$this->validate($request, $this->rules());
		//getting parent comment
    	$parentComment = Comment::find($request->comment_id);
		//creating child comment
    	$comment = new Comment;
    	$comment->text = $request->text;
    	$comment->user_id = Auth::id();
    	$comment->parent_id = $parentComment->id;
    	$comment->first_parent_id = $parentComment->first_parent_id??$parentComment->id;
    	$comment->commentable_id = $parentComment->commentable_id;
    	$comment->commentable_type = $parentComment->commentable_type;
    	$comment->save();
    	//loading user to created comment
        $comment->load('user');

		return response($comment->toJson(), 200);
	}

	public function all(Request $request, int $c_id){
		$comments = Comment::where('parent_id', $c_id)
							->withCount('childs')
							->withCount('activeLikes')
							->get();
		$comments->load('user');
		return response($comments->toJson(),200);
	}

	protected function rules(){
		return [
			'text' => 'required|min:1',
			'comment_id' => 'required|exists:comments,id',
			'grecaptcha' => 'required|grecaptcha'
		];
	}
}
