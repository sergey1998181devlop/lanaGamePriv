<?php

namespace  App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\club;
use App\User;
use App\comment;
use Auth;
use Carbon\Carbon;
class clubsController extends Controller
{
    public function __construct()
    {
        $this->middleware('rule:1');
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
        $club = club::select('published_at','draft','id','user_id','url')->UnderEdit()->findOrFail($id);
        $comment  = new comment();
        $comment ->club_id =  $id;
        $comment ->comment =  $request->input('comment');
        $comment->created_by = Auth::user()->id;
        $comment -> save();
        return redirect('clubs/'.$club->id.'/'.$club->url);
    }
}
