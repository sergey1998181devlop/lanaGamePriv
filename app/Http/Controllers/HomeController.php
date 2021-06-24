<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\club;
use App\city;
use App\metro;
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
        $clubs= club::SelectCartFeilds4Home()->Published()->CorrentCity()->whereNull('hidden_at')->with(array('metro'=>function($query) {
          $query->select('id','name','color');
      }))->orderBy('club_min_price','ASC')->paginate(6);
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
      if(($request->input('q'))){
        $cities=city::select('id','name','en_name','metroMap')->where('name', 'like', '%' . $request->input('q') . '%')->orWhere('en_name', 'like', '%' . $request->input('q') . '%')->paginate(6);
          if(count($cities) >= 5){
            $b["pagination"]= [
              "more"=> true
            ];
          }
      }else{

        $correntCity = city::select('id','name','en_name','metroMap')->find(($request->input('selected') ? $request->input('selected') : city(true)['id']));
        $b["results"][]=[ "text"=> $correntCity->name, "data"=> $correntCity->en_name,'id'=>$correntCity->id ,'has_metro' =>  $correntCity->metroMap ];
        $defCities = [637640,653240,650400,634450];
        if($correntCity){
          if (($key = array_search($correntCity->id, $defCities)) !== false) {
            unset($defCities[$key]);
          }
        }
        $cities=city::select('id','name','en_name','metroMap')->whereIn('id',$defCities)->get();
      }
     
      foreach ($cities as $city) {
       $b["results"][]=[ "text"=> $city->name, "data"=> $city->en_name,'id'=>$city->id,'has_metro' =>  $city->metroMap  ];
      }
      
      return response($b);
   }
   public function searchMetro(Request $request){
    $b = array();
    $b['query']='Unit';
    if(($request->input('q'))){
      $metros=metro::select('id','name','color')->where('city_id',$request->input('city_id'))->where('name', 'like', '%' . $request->input('q') . '%')->paginate(10);
        if(count($metros) >= 9){
          $b["pagination"]= [
            "more"=> true
          ];
        }
    }else{
      $metros=metro::select('id','name','color')->where('city_id',$request->input('city_id'))->paginate(10);
    }
    foreach ($metros as $metro) {
      $b["results"][]=[ "text"=> $metro->name,'id'=>$metro->id,'color' =>  $metro->color  ];
     }
     return response($b);
   }
}
