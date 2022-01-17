<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Str;
use Auth;
use App\post;
use App\post_comment;
use App\Http\Requests\ApiLikeRequest;
use App\Http\Requests\ApiUnlikeRequest;
use ImageResize;
use Illuminate\Support\Facades\Validator;
class postsController extends Controller
{
    public $totalComments;
    public function __construct()
    {
        $this->totalComments = 0;
        $this->middleware('auth:api', ['only' => ['storeComment','saveImage']]);
    }
    public function post($id){
        $post=post::where('id',$id)->select('id','name','about','image','created_at','views')->withCount('commentsTotal')->first();
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
        if($post->comments_total_count > 0){
            $messageForComments = msgfmt_create('ru_RU', '{count, plural, one{# комментарий} few{# комментария} many{# комментариев} other{# комментария}}');
            $post->totalComments = $messageForComments->format(['count' => $post->comments_total_count]);
        }else{
            $post->totalComments = 'Нет комментариев';
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
            if($this->totalComments > 0){
                $messageForComments = msgfmt_create('ru_RU', '{count, plural, one{# комментарий} few{# комментария} many{# комментариев} other{# комментария}}');
                $comments_total_count = $messageForComments->format(['count' => $this->totalComments]);
            }else{
                $comments_total_count = 'Нет комментариев';
            }
        return response()->json(['status'=>true,'comments'=>$comments,'comments_total_count' => $comments_total_count,'totalComments'=>$this->totalComments]);
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
            $this->totalComments++;
        }
        return $commentsAr;
     }
     public function storeComment(Request $request)
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
            return response()->json(['status'=>true,'id'=>$comment->id,'user_name'=>$request->user()->name,'user_type'=> $request->user()->type == 'player' ? 'Игрок' : 'Представитель клуба','created_at'=>timelabe($comment->created_at)]);
        }
        return response()->json(['status'=>false]);
    }

    public function saveImage(Request $request){
        $this->imageSaver($request,'clubs');
     }
     public function savePriceList(Request $request){
         $this->imageSaver($request,'clubs/lists');
     }
     public function imageSaver(Request $request,$folder = 'clubs'){
         $validator = Validator::make($request->all(), [
             'file' => ['required', 'image','max:5500']
         ]);
         if ($validator->fails()) {
             jsonValidationException(['file' => $validator->errors()->first()]);
         }
         $message = $url = '';
         if ($request->hasFile('file')) {
             $file = $request->file('file');
             if ($file->isValid()) {
                 $uniqie=time().uniqid();
                 $filename = $uniqie.'.'.$file->getClientOriginalExtension();
                 $subPath = date("Y").'/'.date("M").'/'.date("d");
                 if (!file_exists(storage_path('app/public/'.$folder.'/'.$subPath))) {
                     mkdir(storage_path('app/public/'.$folder.'/'.$subPath), 0777, true);
                 }
                 $file->move(storage_path('app/public/'.$folder.'/'.$subPath), $filename);
                 $url = url('storage/'.$folder).'/'.$subPath.'/'.$filename;
                 header('Content-type: application/json');
                 \http_response_code(200);
                 echo json_encode(['status'=>true,'data'=>$url]);
                 exit();
             }
         }
         jsonValidationException(['file' => 'Произошла ошибка при загрузке файла']);
     }
     public function like(ApiLikeRequest $request)
     {
        Auth::guard('api')->user()->like($request->likeable());
        return response()->json(['status'=>true]);
     }
 
     public function unlike(ApiUnlikeRequest $request)
     {
        Auth::guard('api')->user()->unlike($request->likeable());
        return response()->json(['status'=>true]);
     }
}