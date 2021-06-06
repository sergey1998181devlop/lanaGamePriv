<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=post::orderBy('created_at','desc')->limit(3)->get();
        $postsCount=post::count();
        return view('welcome')->with(['posts'=>$posts,'postsCount'=>$postsCount]);
    }
}
