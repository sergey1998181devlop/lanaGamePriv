<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post_comment;
use App\post;
use View;
use App\Http\Requests\LikeRequest;
use App\Http\Requests\UnlikeRequest;
class CommentController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $comment = new post_comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $comment->parent_id = null;
        if((int) $request->input('comment_id') > 0 ){
            $comment->parent_id = $request->get('comment_id');
        }
        $post = post::find($request->get('post_id'));
        if($comment=$post->comments()->save($comment)){
            $view = View::make('posts.posts_comment_replies', [
                'comments' => [$comment],
                'post'=>$post,
                'fromController' =>true
            ]);
            $html= $view->render();
            return response()->json(['status'=>true,'id'=>$comment->id,'html'=>$html,'user_name'=>$request->user()->name,'user_type'=> $request->user()->type == 'player' ? 'Игрок' : 'Представитель клуба']);
        }
        return response()->json(['status'=>false]);
    }
    public function like(LikeRequest $request)
    {
        $request->user()->like($request->likeable());

        if ($request->ajax()) {
            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }

    public function unlike(UnlikeRequest $request)
    {
        $request->user()->unlike($request->likeable());

        if ($request->ajax()) {
            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }
}
