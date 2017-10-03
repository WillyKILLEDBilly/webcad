<?php

namespace App\Http\Controllers\Comments;

use Auth;
use App\Models\Detail;
use App\Models\Comment;
use App\Helpers\Recaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailCommentController extends Controller
{
    public function add(Request $request){
    	$this->validate($request, $this->rules());
    	//creating new comment
        $comment = new Comment;
        $comment->text = $request->text;
        $comment->user_id = Auth::id();
        //saving comment to a given detail
       	Detail::find($request->detail_id)
       		->comments()
       		->save($comment);
       	//getting comment user
       	$comment->load('user');
        //responsing created comment
    	return response($comment->toJson(), 200);
    }

    public function all(Request $request,int $d_id){
    	$comments = Detail::findOrFail($d_id)
            ->comments()
            ->where('parent_id', null)
            ->withCount('childs')
            ->withCount('activeLikes')
            ->with('user')
            ->get();
		return response($comments->toJson(), 200);
    }

    protected function rules(){
    	return [
	    	'text' => 'required|min:1',
	    	'detail_id' => 'required|exists:details,id',
            'grecaptcha' => 'required|grecaptcha'
    	];
    }
}
