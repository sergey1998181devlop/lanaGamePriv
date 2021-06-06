<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

use App\post;
// include_once(resource_path('views/includes/functions.blade.php')); 
class postsController extends Controller
{
    public function post($id,$url){

        $post=post::where('id',$id)->first();
        
        if(!$post ){
            abort(405);
        }
           $views=$post->views;
           $views++;
           $post->views=$views;
            $post->save();
        return view('posts.post')->with(['post'=>$post]);
     }
     public function allposts(){

        $posts=post::orderBy('created_at','desc')->paginate(10);

        return view('posts.posts')->with(['posts'=>$posts]);
     }
     
}
