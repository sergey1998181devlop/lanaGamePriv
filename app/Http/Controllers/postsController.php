<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Str;

use App\post;
include_once(resource_path('views/includes/functions.blade.php')); 
class postsController extends Controller
{
    public function post($id,$url){
        $post=post::where('id',$id)->withCount('commentsTotal')->first();
        if(!$post ){
            abort(404);
        }
        if ($url != Str::slug($post->url)){
            return redirect($post->id.'_statia_'.Str::slug($post->url));
        }
        $views=$post->views;
        $views++;
        $post->views=$views;
        $post->timestamps = false;
        $post->save();
        $morePosts = post::select('id','url','image','name')->where('id','!=',$post->id)->inRandomOrder()->limit(2)->get();
        return view('posts.post')->with(['post'=>$post,'morePosts'=>$morePosts]);
     }
     public function allposts(){

        $posts=post::orderBy('order_no','desc')->orderBy('created_at','desc')->paginate(100);

        return view('posts.posts')->with(['posts'=>$posts]);
     }
     
}
