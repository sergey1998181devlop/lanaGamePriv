<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post_comment;
use App\post;
use View;
use App\Http\Requests\LikeRequest;
use App\Http\Requests\UnlikeRequest;
use ImageResize;
class CommentController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        if($request->input('comment_body') == '' && $request->input('comment_photo') == ''){
            return response()->json(['status'=>false,'msg'=>'Напишите комментарий']);
        }
        $comment = new post_comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $comment->parent_id = null;
        if((int) $request->input('comment_id') > 0 ){
            $comment->parent_id = $request->get('comment_id');
        }
        if($request->input('comment_photo') != ''){
            $comment->image = $request->get('comment_photo');
            $comment->image_thumbnail = '';
            $filename = explode('clubs/',$request->get('comment_photo'));
            if(isset($filename[1])){
                $filename=$filename[1];
                if(file_exists(storage_path('app/public/clubs/'.$filename))){
                    $infoPath = pathinfo(storage_path('app/public/clubs/'.$filename));
                    $subPath = date("Y").'/'.date("M").'/'.date("d");
                    if (!file_exists(storage_path('app/public/clubs/thumbnail/'.$subPath))) {
                        mkdir(storage_path('app/public/clubs/thumbnail/'.$subPath), 0777, true);
                    }
                    if($infoPath['extension'] != 'jfif' &&  $infoPath['extension'] != 'HEIC'){
                        $destinationPath = storage_path('app/public/clubs/thumbnail/'.$subPath);
                            $img = ImageResize::make(storage_path('app/public/clubs/'.$filename));
                            $img->resize(300,'auto', function ($constraint) {
                                $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$infoPath['basename']);
                        $comment->image_thumbnail =  url('storage/clubs/thumbnail').'/'.$subPath.'/'. $infoPath['basename'];
                    }
                }
            }
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
