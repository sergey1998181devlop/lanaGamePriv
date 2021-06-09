<?php

namespace  App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\club;
use App\User;
use Auth;
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
        // print_r($newClubs);
        // die();
        return view('admin.clubs.new-clubs')->with(['clubs'=>$newClubs]);
    }
}
