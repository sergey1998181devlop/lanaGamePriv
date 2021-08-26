<?php

namespace  App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\club;
use App\User;
use App\comment;
use Auth;
use Carbon\Carbon;
use Notification;
use App\Notifications\userNotification;
class clubsController extends Controller
{
    public function __construct()
    {
        $this->middleware('rule:1')->except('sendMails');
    }
    public function clubs()
    {
        $newClubs= club::select('id','user_id','club_name','updated_at','url','club_city','published_at','published_by','hidden_at','created_at','last_admin_edit','unpublished_at')->with(array('user' => function($query) {
            $query->select('id','name','phone');
            },'city' => function($query) {
                $query->select('id','name');
        },
        'lastAdminEdit' => function($query) {
            $query->select('id','name');
        }))->where('draft','0')->orderBy('updated_at','DESC')->get();
        return view('admin.clubs.clubs')->with(['clubs'=>$newClubs]);
    }
    public function new_clubs()
    {
        $newClubs= club::select('id','user_id','club_name','club_city','updated_at','created_at','url')->with(array('user' => function($query) {
        $query->select('id','name','phone');
    },'city' => function($query) {
        $query->select('id','name');
    },'comments' => function($query) {
        $query->select('id','club_id','created_at');
    }))->UnderEdit()->whereNull('unpublished_at')->orderBy('updated_at','DESC')->get();
        return view('admin.clubs.new-clubs')->with(['clubs'=>$newClubs]);
    }
    public function hidded_clubs()
    {
        $clubs= club::select('id','user_id','club_name','club_city','updated_at','created_at','url','unpublished_at','unpublished_by')->with(array('user' => function($query) {
        $query->select('id','name','phone');
    },'city' => function($query) {
        $query->select('id','name');
    },'whoUnPublished' => function($query) {
        $query->select('id','name');
    },'comments' => function($query) {
        $query->select('id','club_id','created_at','comment');
    }
    ))->Hidded()->orderBy('updated_at','DESC')->get();
        return view('admin.clubs.hidded-clubs')->with(['clubs'=>$clubs]);
    }
    
    
    public function active($id){
        $club = club::select('published_at','published_by','unpublished_by','unpublished_at','draft','id','user_id','url')->UnderEdit()->findOrFail($id);
        $club->published_at =Carbon::now()->toDateTimeString();
        $club->published_by =Auth::user()->id;
        $club->unpublished_at =null;
        $club->unpublished_by =null;
        $club->last_admin_edit =Auth::user()->id;
        $club->save();
        $club->comments()->delete();
        return redirect('clubs/'.$club->id.'/'.$club->url);
    }
    public function comment($id,Request $request){
        $club = club::select('published_at','published_by','draft','id','user_id','url','club_name')->findOrFail($id);
        if( $club->published_at != null ){
            $club->published_at = null;
            $club->published_by =Auth::user()->id;
            $club->unpublished_at =Carbon::now()->toDateTimeString();;
            $club->unpublished_by =Auth::user()->id;
            $club->last_admin_edit =Auth::user()->id;
            $club->save();
        }
        $comment  = new comment();
        $comment ->club_id =  $id;
        $comment ->comment =  $request->input('comment');
        $comment->created_by = Auth::user()->id;
        $comment -> save();
        return redirect('clubs/'.$club->id.'/'.$club->url);
    }
    public function changeClubUser($id,Request $request){
        $club = club::findOrFail($id);
        $newUser = User::findOrFail($request->input('new_user'));
        $club->user_id=$newUser->id;
        $club->last_admin_edit =Auth::user()->id;

        $club->save();
        return redirect('clubs/'.$club->id.'/'.$club->url.'/?status=success');
    }
    public function sendMails(Request $request){
      if($request->input('s') != '!dw23@saf'){
          return '';
      }
      $comments = comment::whereNull('sent_at')->with(array('club' => function($query) {
            $query->select('id','club_name','user_id');
        },'club.user'))->get();
        
      foreach($comments as $comment){
          if(!$comment->club || !$comment->club->user)continue;
          if($comment->club->user->id == 10)continue; //parser user -- no email
            // send notification
            $details = [
                'subject' =>'Комментарий модератора на Langame',
                'body' => 'Модератор Langame отправил вам по вашему клубу <strong>'.$comment->club->club_name.'</strong> комментарий: '.$comment->comment,
                'content' => 'Для редактирования клуба пройдите <a href="'.url('personal/club/'.$comment->club->id.'/edit').'">по ссылке</a>',
            ];
            Notification::send($comment->club->user, new userNotification($details));
            $comment->sent_at = Carbon::now()->toDateTimeString();
            $comment->save();
      }
    }
    public function deleteClub($id){
        $club = club::findOrFail($id);
        $club->delete();
        return back();
    }
}
