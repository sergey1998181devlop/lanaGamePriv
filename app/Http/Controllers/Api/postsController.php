<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Str;
use Auth;
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
     public function getPostComments($id,Request $request){
        $post=post::where('id',$id)->first();
        if(!$post ){
            return response()->json(['status'=>false,'msg'=>'non_found'], 202);
        }
        $commentsBy = $request->input('sc_b') == 'in_order' ? 'in_order' : 'popular';

        $comments = $this->generateComments(
            $commentsBy == 'in_order' ?
                $post->comments
                :
                $post->comments->sortByDesc(function($comment) {
                    return ($comment->likes->count() - $comment->unLikes->count()) + $comment->replies->count();
                })
            ,$commentsBy);
        return response()->json($comments, 202);
     }
     public function generateComments($comments,$commentsBy){
        $commentsAr = [];
        foreach($comments as $comment){
            $likeable = 'none';
            if (Auth::guard('api')->check()) {
                if (Auth::guard('api')->user()->hasUnLiked($comment)) {
                    $likeable = 'unliked';
                } else if (Auth::guard('api')->user()->hasLiked($comment)) {
                    $likeable = 'liked';
                }
            }
            $comment->status = $likeable ;
            $comment->user_name=$comment->user->name;
            $comment->user_type=$comment->user->type == 'player' ? 'Игрок' : 'Представитель клуба';
            $comment->totalLikes = $comment->likes->count() - $comment->unLikes->count();
            
            $replies  = $this->generateComments(
            $commentsBy == 'in_order' ? 
                $comment->replies
                :
                $comment->replies->sortByDesc(function($comment) {
                    return ($comment->likes->count() - $comment->unLikes->count()) + $comment->replies->count();
                })
            ,$commentsBy);
            unset($comment->replies);
            $comment->replies = $replies ;
            unset($comment->likes);
            unset($comment->un_likes);
            unset($comment->unLikes);
            unset($comment->user);
            unset($comment->user_id);
            $commentsAr[] = $comment;
        }
        return $commentsAr;
     }
}
