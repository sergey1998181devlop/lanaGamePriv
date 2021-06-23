<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\club;
use App\city;
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
        $clubs= club::SelectCartFeilds4Home()->Published()->CorrentCity()->whereNull('hidden_at')->orderBy('club_min_price','ASC')->paginate(6);
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
    public function searchCities(Request $request){
      $b = array();
      $b['query']='Unit';
      if(($request->input('term'))){
        $cities=city::select('id','name','en_name')->where('name', 'like', '%' . $request->input('q') . '%')->orWhere('en_name', 'like', '%' . $request->input('q') . '%')->paginate(6);
          if(count($cities) == 5){
            $b["pagination"]= [
              "more"=> true
            ];
          }
      }else{

        $correntCity = city::select('id','name','en_name')->find(($request->input('selected') ? $request->input('selected') : city(true)['id']));
        $b["results"][]=[ "text"=> $correntCity->name, "data"=> $correntCity->en_name,'id'=>$correntCity->id ];
        $defCities = [637640,653240,650400,634450];
        if($correntCity){
          if (($key = array_search($correntCity->id, $defCities)) !== false) {
            unset($defCities[$key]);
          }
        }
        $cities=city::select('id','name','en_name')->whereIn('id',$defCities)->get();
      }
     
      foreach ($cities as $city) {
       $b["results"][]=[ "text"=> $city->name, "data"=> $city->en_name,'id'=>$city->id ];
      }
      
      return response($b);
   }
}
