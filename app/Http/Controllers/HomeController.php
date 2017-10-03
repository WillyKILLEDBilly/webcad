<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Detail;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Show the home page of application
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    	$details = Detail::all();
        return view('home.home', compact('details'));
    }
}