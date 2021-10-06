<?php

namespace  App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\club;
use App\city;
use App\User;
use App\comment;
use Auth;
use Carbon\Carbon;
use Notification;
use Str;
use App\Notifications\userNotification;
class clubsController extends Controller
{
    public function __construct()
    {
        $this->middleware('rule:1')->except('sendMails');
    }
    public function clubs()
    {
        $newClubs= club::select('id','user_id','club_name','updated_at','url','phone','club_instagram_link','club_vk_link','club_email','club_city','published_at','published_by','hidden_at','created_at','last_admin_edit','unpublished_at')->with(array('user' => function($query) {
            $query->select('id','name','phone');
            },'city' => function($query) {
                $query->select('id','name','en_name');
        },
        'lastAdminEdit' => function($query) {
            $query->select('id','name');
        }))->where('draft','0')->orderBy('updated_at','DESC');
        if(isset($_GET['onlyPublished']) && $_GET['onlyPublished'] == 'true'){
            $newClubs=$newClubs->Published();
        }
        $city = 'all';
        if(isset($_GET['city']) && $_GET['city'] != ''){
         $selectedCity = city::find($_GET['city']);
         if($selectedCity){
            $newClubs=$newClubs->where('club_city',$selectedCity->id);
            $city = $selectedCity->name;
         }
        }
        $newClubs=$newClubs->get();
        return view('admin.clubs.clubs')->with(['clubs'=>$newClubs,'city'=>$city]);
    }
    public function new_clubs()
    {
        $newClubs= club::select('id','user_id','club_name','club_city','updated_at','created_at','url')->with(array('user' => function($query) {
        $query->select('id','name','phone');
    },'city' => function($query) {
        $query->select('id','name','en_name');
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
            $query->select('id','name','en_name');
        },'whoUnPublished' => function($query) {
            $query->select('id','name');
        },'comments' => function($query) {
            $query->select('id','club_id','created_at','comment');
        }
        ))->Hidded()->orderBy('updated_at','DESC')->get();
        return view('admin.clubs.hidded-clubs')->with(['clubs'=>$clubs]);
    }
    public function deleted_clubs()
    {
        $clubs= club::select('id','user_id','club_name','club_city','deleted_at','deleted_by','created_at','url','unpublished_at','unpublished_by')->with(array('user' => function($query) {
        $query->select('id','name','phone');
        },'city' => function($query) {
            $query->select('id','name','en_name');
        },'deletedBy' => function($query) {
            $query->select('id','name');
        }
        ))->onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('admin.clubs.deleted-clubs')->with(['clubs'=>$clubs]);
    }
    public function drafts()
    {
        $clubs= club::select('id','user_id','club_name','club_city','updated_at','created_at')->with(array('user' => function($query) {
        $query->select('id','name','phone');
        },'city' => function($query) {
            $query->select('id','name');
        }
        ))->Draft()->orderBy('updated_at','DESC')->get();
        return view('admin.clubs.drafts')->with(['clubs'=>$clubs]);
    }
    public function active($id){
        $club = club::select('published_at','published_by','unpublished_by','unpublished_at','draft','id','user_id','url','club_city')->UnderEdit()->with(array('city' => function($query) {
                $query->select('id','en_name');
            }))->findOrFail($id);
        $club->published_at =Carbon::now()->toDateTimeString();
        $club->published_by =Auth::user()->id;
        $club->unpublished_at =null;
        $club->unpublished_by =null;
        $club->last_admin_edit =Auth::user()->id;
        $club->save();
        $club->comments()->delete();
        return redirect($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name);
    }
    public function comment($id,Request $request){
        $club = club::select('published_at','published_by','draft','id','user_id','url','club_name','club_city')->with(array('city' => function($query) {
            $query->select('id','en_name');
        }))->findOrFail($id);
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
        $comment->send_mail=($request->input('send_mail') == 'on') ? '1' : '0';
        $comment -> save();
        return redirect($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name);
    }
    public function removeComment($club_id,Request $request){
        $comment = comment::where('id',$request->input('id'))->where('club_id',$club_id)->delete();
        if($comment){
            return response()->json(['status'=>true]);
        }
    }
    public function changeClubUser($id,Request $request){
        $club = club::with(array('city' => function($query) {
            $query->select('id','en_name');
        }))->findOrFail($id);
        $newUser = User::findOrFail($request->input('new_user'));
        $club->user_id=$newUser->id;
        $club->last_admin_edit =Auth::user()->id;

        $club->save();
        return redirect($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name.'/?status=success');
    }
    public function sendMails(Request $request){
      if($request->input('s') != '!dw23@saf'){
          echo 'false';
          return;
      }
      $comments = comment::whereNull('sent_at')->where('send_mail','1')->with(array('club' => function($query) {
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
      echo count($comments);
      return;
    }
    public function deleteClub($id){
        $club = club::findOrFail($id);
        $club->deleted_by=Auth::user()->id;
        $club->save();
        $club->delete();
        return back();
    }
    public function recoverClub($id){
        $club = club::withTrashed()->findOrFail($id);
        $club->deleted_by=Auth::user()->id;
        $club->deleted_at=null;
        $club->save();
        return redirect('clubs/'.$club->id.'/'.Str::slug($club->url).'/?status=success');
    }
    public function exportClubs(){
        $сlubs= club::with(array('user' => function($query) {
            $query->select('id','name','phone');
            },'city' => function($query) {
                $query->select('id','name','en_name','parentName');
        }))->where('draft','0')->orderBy('updated_at','DESC')->get();
        $file = (new \App\Jobs\PHPExcl())->createFile($сlubs);
    }
}
