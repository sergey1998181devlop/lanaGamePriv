<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post_comment;
use App\post;
use View;
class CommentController extends Controller
{
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
                'post'=>$post
            ]);
            $html= $view->render();
            return response()->json(['status'=>true,'id'=>$comment->id,'html'=>$html]);
        }
        return response()->json(['status'=>false]);
    }

}
