<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\club;
use View;
include_once(resource_path('views/includes/functions.blade.php')); 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clubs= club::SelectCartFeilds4Home()->Published()->whereNull('hidden_at')->orderBy('club_min_price','ASC')->paginate(6);
        if(\Request::ajax())
        {
            $html = '';
          foreach ($clubs as $club) {
            $view = View::make('club', [
                'club' => $club
            ]);
            $html .= $view->render();
          }
          return response()->json(['html' => $html,'last'=>$clubs->lastPage()]);
        }
        $posts=post::orderBy('created_at','desc')->limit(3)->get();
        $postsCount=post::count();
        return view('welcome')->with(['posts'=>$posts,'postsCount'=>$postsCount,'clubs'=>$clubs]);
    }
}
