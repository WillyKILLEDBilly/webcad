<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Detail;
use App\Models\Comment;
use App\Models\DetailView;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function getDetail(Request $request,$linkName){
    	//try to get detail by link name or 404
    	$detail = Detail::where('link_name', $linkName)->firstOrFail();

    	//getting a view if it exists
    	$view = DetailView::where([
    			['detail_id', $detail->id],
    			['visitor', $request->ip()]
    		])->first();
    	//create new view if not
    	if ($view==null) {
    		$view = new DetailView;
	    	$view->detail_id = $detail->id;
	    	$view->visitor = $request->ip();
	    	$view->save();
    	}
        
    	return view('detail.detail', compact('detail'));
    }
}