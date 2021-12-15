<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post_comment;
use App\post;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new post_comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        if((int) $request->input('comment_id') > 0 ){
            $comment->parent_id = $request->get('comment_id');
        }
        $post = post::find($request->get('post_id'));
        if($post->comments()->save($comment)){
            return back();
        }

        
    }

}
