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
        $newClubs= club::select('id','user_id','club_name','updated_at','url','club_city')->with(array('user' => function($query) {
        $query->select('id','name');
    },'city' => function($query) {
        $query->select('id','name');
    }))->Published()->orderBy('updated_at','DESC')->paginate(10);
        return view('admin.clubs.clubs')->with(['clubs'=>$newClubs]);
    }
    public function new_clubs()
    {
        $newClubs= club::select('id','user_id','club_name','updated_at','url')->with(array('user' => function($query) {
        $query->select('id','name');
    }))->UnderEdit()->orderBy('updated_at','DESC')->get();
        return view('admin.clubs.new-clubs')->with(['clubs'=>$newClubs]);
    }
    public function active($id){
        $club = club::select('published_at','published_by','draft','id','user_id','url')->UnderEdit()->findOrFail($id);
        $club->published_at =Carbon::now()->toDateTimeString();
        $club->published_by =Auth::user()->id;
        $club->save();
        $club->comments()->delete();
        return redirect('clubs/'.$club->id.'/'.$club->url);
    }
    public function comment($id,Request $request){
        $club = club::select('published_at','draft','id','user_id','url','club_name')->findOrFail($id);
        if( $club->published_at != null ){
            $club->published_at = null;
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
}
