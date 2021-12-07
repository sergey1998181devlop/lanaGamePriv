<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Str;

use App\post;
class postsController extends Controller
{
    public function post($id){
        $post=post::where('id',$id)->select('id','name','about','image','created_at','views')->first();
        if(!$post ){
            return response()->json(['status'=>false,'msg'=>'non_found'], 202);
        }
        $views=$post->views;
        $views++;
        $post->views=$views;
        $post->timestamps = false;
        $post->save();
        $post->image =($post->image != '') ? url('storage/posts/'.$post->image) : asset('img/default-club-preview-image.svg');
        $morePosts = post::select('id','image','name')->where('id','!=',$post->id)->inRandomOrder()->limit(2)->get();
        foreach ($morePosts as $m_post) {
            $m_post->image = ($m_post->image != '') ? url('storage/posts/thumbnail/'.$m_post->image) : asset('img/default-club-preview-image.svg');
        }
        return response()->json(['status'=>true,'post'=>$post,'morePosts'=>$morePosts]);
     }
     public function allposts(){

        $posts=post::select('id','name','about','image','created_at')->orderBy('order_no','desc')->orderBy('created_at','desc')->paginate(9);
        foreach ($posts as $post) {
            $post->image = ($post->image != '') ? url('storage/posts/thumbnail/'.$post->image) : asset('img/default-club-preview-image.svg');
            $post->about=\Illuminate\Support\Str::limit(strip_tags($post->about),200, '...');
            
          }
        $data['posts'] =$posts;
        $data['status']=true;
        return response()->json($data, 202);
     }
     
}
