<?php

namespace App\Http\Controllers;

use App\city;
use App\club;
use App\metro;
use App\offer;
use App\post;
use Auth;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Http\Request;
use View;
include_once(resource_path('views/includes/functions.blade.php'));
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('owner',['only' => ['searchMetro']]);
    }

    public function clubs_offers(){
      $offersMyClub = [];
      $paginate = 6;
      if(owner()){
        $offersMyClub=offer::where('offers.user_id', Auth::user()->id)->get();
      }
      $offersBrand=offer::where('type', 'newBrand')->where('published_at','!=', null)->orderBy('order_no','desc')->orderBy('created_at','desc')->paginate($paginate);
      $offersClub=offer::where('type', 'newClub')->where('published_at','!=', null)->with('user','linkedClub','firstClub')
      ->orderBy('order_no','desc')->orderBy('created_at','desc')->get();
      if(\Request::ajax())
      {
        $html = '';
        foreach ($offersBrand as $offer) {
          $view = View::make('offer', [
              'offer' => $offer
          ]);
          $html .= $view->render();
        }
        return response()->json(['html' => $html,'last'=>$offersBrand->lastPage(),'total'=>$offersBrand->total()]);
      }
      return view('about.clubs_offers')->with(['offersBrand'=>$offersBrand,'offersClub'=>$offersClub, 'offersMyClub'=>$offersMyClub, 'hasMoreOffersBrand'=>($offersBrand->total() > $paginate ) ? true : false]);
    }
    public function cities_list(){
        $cities = city::query()->orderBy('name', 'asc')->get();

        return view('about.cities_list', [
            'cities' => $cities,
        ]);
    }
    public function homePage(){
      if (empty($_COOKIE["lat"]) && empty($_COOKIE['lon'])){
        $api_yandex = new \Yandex\Locator\Api('AP2BymABAAAAAqumUgIAzSJaePpJPDsATaQ5CtyPNtLdC60AAAAAAAAAAABVXZbOLoQ1EhZSTVkNehJDKsp9Dg==');
        $api_yandex->setIp($_SERVER['REMOTE_ADDR']);
        $lat = '';
        $lon = '';
        try {
            $api_yandex->load();
            $response = $api_yandex->getResponse();
            $lat = $response->getLatitude();
            $lon = $response->getLongitude();
            setcookie("lat", $lat);
            setcookie("lon", $lon);
            setcookie("geo", "yandex");
        } catch (\Yandex\Locator\Exception\CurlError $ex) {
            // ошибка curl
        } catch (\Yandex\Locator\Exception\ServerError $ex) {
            // ошибка Яндекса
        } catch (\Yandex\Locator\Exception $ex) {
            // какая-то другая ошибка (запроса, например)
        }

      }else{
        $lat = $_COOKIE["lat"];
        $lon = $_COOKIE["lon"];
        setcookie("geo", "browser");
      }
      $clubs= club::SelectCartFeilds4Home($lat, $lon)->Published()->whereNull('hidden_at')->where('closed','0')->with(array('metro'=>function($query) {
        $query->select('id','name','color');
      }))->where('rating', '>' ,4)->inRandomOrder()->limit(3)->get();
      $posts=post::select('id','url','image','name','about')->orderBy('order_no','desc')->orderBy('created_at','desc')->limit(3)->get();
      $postsCount=post::count();
      $now = new DateTime();
      $today = strtolower(date("l"));

      return view('main')->with([
          'clubs' => $clubs,
          'posts' => $posts,
          'postsCount' => $postsCount,
          'now' => $now,
          'today' => $today,
          'mainPage' => true,
          'headerBlogLinkWithAnchor' => true,
      ]);
    }
    public function index(Request $request)
    {
      if (empty($_COOKIE["lat"]) && empty($_COOKIE['lon'])){
        $api_yandex = new \Yandex\Locator\Api('AP2BymABAAAAAqumUgIAzSJaePpJPDsATaQ5CtyPNtLdC60AAAAAAAAAAABVXZbOLoQ1EhZSTVkNehJDKsp9Dg==');
        $api_yandex->setIp($_SERVER['REMOTE_ADDR']);
        $lat = '';
        $lon = '';
        try {
            $api_yandex->load();
            $response = $api_yandex->getResponse();
            $lat = $response->getLatitude();
            $lon = $response->getLongitude();
            setcookie("lat", $lat);
            setcookie("lon", $lon);
            setcookie("geo", "yandex");
        } catch (\Yandex\Locator\Exception\CurlError $ex) {
            // ошибка curl
        } catch (\Yandex\Locator\Exception\ServerError $ex) {
            // ошибка Яндекса
        } catch (\Yandex\Locator\Exception $ex) {
            // какая-то другая ошибка (запроса, например)
        }

      }else{
        $lat = $_COOKIE["lat"];
        $lon = $_COOKIE["lon"];
        setcookie("geo", "browser");
      }

      $order = '';
      $order_key='ASC';
      if($request->input('order') == 'nearby'){
        $order = 'nearby';
      }elseif ($request->input('order') == 'rating') {
        $order = 'rating';
        $order_key='DESC';
      }elseif ($request->input('order') == 'price') {
        $order = 'club_min_price';
        $order_key='ASC';
      }
      if ($request->input('order_key') == "desc"){
        $order_key = "DESC";
      }
      if ($request->input('order_key') == "asc"){
        $order_key = "ASC";
      }
      $paginate = 9;
      $paginateRand=999999999; //для создании рандомный порядок
      if ($request->input('show') == "map"){
        $paginate = 999999999999999; // показать все
      }
      if (!empty($request->input('search'))){
        $search_string = $request->input('search');
      }else{
        $search_string = "";
      }

      $clubs= club::SelectCartFeilds4Home($lat, $lon)->Published()->whereNull('hidden_at');

      if ($request->input('show') == "map"){
        $clubs=$clubs->where('closed','0')->with(array('metro'=>function($query) {
          $query->select('id','name','color');
        },'city'=>function($query) {
          $query->select('id','name','en_name');
        }));
      }else{
        $clubs=$clubs->CorrentCity()->whereNull('hidden_at')->where('club_name', 'like', '%'.$search_string.'%')->orderBy('closed')->with(array('metro'=>function($query) {
          $query->select('id','name','color');
        }));
      }
      if($order == ''){
        if(\Request::ajax())
        {
          if(isset($_COOKIE["randOrder"])){
            $randOrder = $_COOKIE["randOrder"];
          }else{
            $randOrder = rand(10,$paginateRand);
            setcookie("randOrder", $randOrder);
          }
        }else{
         $randOrder = rand(10,$paginateRand);
         setcookie("randOrder", $randOrder);
        }
        $clubs=$clubs->inRandomOrder($randOrder);
      }else{
        $clubs=$clubs->orderBy($order,$order_key);
      }
      $clubs=$clubs->paginate($paginate);

      $totalClubsWithoutClosed = ($request->input('show') == "map") ? $clubs->total() : club::Published()->whereNull('hidden_at')->where('closed','0')->CorrentCity()->count();
       $now = new DateTime();
       $today = strtolower(date("l"));
        if(\Request::ajax())
        {
            $html = '';
          foreach ($clubs as $club) {
            $view = View::make('club', [
                'club' => $club,
                'now'=>$now,'today'=>$today
            ]);
            $html .= $view->render();
          }
          return response()->json(['html' => $html,'last'=>$clubs->lastPage(),'total'=>$clubs->total()]);
        }
        $posts=post::select('id','url','image','name','about')->orderBy('order_no','desc')->orderBy('created_at','desc')->limit(3)->get();
        $postsCount=post::count();

        return view('welcome')->with([
            'count_clubs' => $clubs->total(),
            'totalClubsWithoutClosed' => $totalClubsWithoutClosed,
            'posts' => $posts,
            'postsCount' => $postsCount,
            'clubs' => $clubs,
            'now' => $now,
            'today' => $today,
            'hasMoreClubs' => $clubs->total() > $paginate,
            'headerBlogLinkWithAnchor' => true,
        ]);
    }
    public function searchCities(Request $request){
      $b = array();
      $b['query']='Unit';
      if($request->input('hasAll') && $request->input('hasAll') == 'true'){
          $b["results"][]=[ "text"=>'Все города', "data"=> 'all','id'=>'all' ,'has_metro' => 'false'];
      }
      if(($request->input('q'))){
        if(($request->input('withR') && $request->input('withR') == 'true') && (!$request->input('page') || $request->input('page') == 1)){
        if (strpos("вся россия",mb_strtolower($request->input('q'),'UTF-8')) !== false) {
          $b["results"][]=[ "text"=>'Вся Россия', "data"=> 'computerniy_club_rossiya','id'=>'0' ,'has_metro' => 'false'];
        }
        }
        $cities=city::select('id','name','en_name','metroMap','parentName')->where('name', 'like', $request->input('q') . '%')->orWhere('en_name', 'like', $request->input('q') . '%')->orderBy('order_no')->paginate(8);
        if($cities->total() == 0){
          $now =Carbon::now()->toDateTimeString();
          $cities_searchs =DB::statement('insert into cities_searchs (query,created_at,updated_at) values ("'.$request->input('q').'","'.$now.'","'.$now.'")');
        }
      }else{
        if($request->input('withR') && $request->input('withR') == 'true'){
          if(!$request->input('page') || $request->input('page') == 1)
          $b["results"][]=[ "text"=>'Вся Россия', "data"=> 'computerniy_club_rossiya','id'=>'0' ,'has_metro' => 'false'];
        }
        $correntCity = city::select('id','name','en_name','metroMap','parentName')->find(($request->input('selected') ? $request->input('selected') : city(true)['id']));
        if($correntCity && !isset($request->page) || $request->page == 1){
          $b["results"][]=[ "text"=> $correntCity->name, "data"=> "computerniy_club_".$correntCity->en_name,'id'=>$correntCity->id ,'has_metro' =>  $correntCity->metroMap ];
        }
        $cities=city::select('id','name','en_name','metroMap','parentName');
        if($correntCity){
          $cities = $cities->where('id','!=',$correntCity->id);
        }
        $cities = $cities->orderBy('order_no')->paginate(8);
      }
      if($cities->lastPage() > $cities->currentPage() ){
        $b["pagination"]= [
          "more"=> true
        ];
      }
      foreach ($cities as $city) {

       $b["results"][]=[ "text"=> ($city->parentName != '') ? $city->name.', '.$city->parentName :  $city->name, "data"=> "computerniy_club_".$city->en_name,'id'=>$city->id,'has_metro' =>  $city->metroMap  ];
      }

      return response($b);
   }
   public function searchMetro(Request $request){
    $b = array();
    $b['query']='Unit';
    if(($request->input('q'))){
      $metros=metro::select('id','name','color')->where('city_id',$request->input('city_id'))->where('name', 'like', '%' . $request->input('q') . '%')->paginate(10);
      if($metros->lastPage() > $metros->currentPage() ){
        $b["pagination"]= [
          "more"=> true
        ];
      }
    }else{
      $metros=metro::select('id','name','color')->where('city_id',$request->input('city_id'))->paginate(10);
      if($metros->lastPage() > $metros->currentPage() ){
        $b["pagination"]= [
          "more"=> true
        ];
      }
    }
    foreach ($metros as $metro) {
      $b["results"][]=[ "text"=> $metro->name,'id'=>$metro->id,'color' =>  $metro->color  ];
     }
     return response($b);
   }
   public function siteMap(){
    $clubs = club::Published()->select('id','url','created_at','club_city')->whereNull('hidden_at')->with(array('city' => function($query) {
      $query->select('id','name', 'en_name');
  }))->get();
    $cites = city::select('id','name','en_name')->get();
    $posts = post::select('id','name','url','created_at')->get();
    $otherLinks = ['about-us','software','register_club','personal/clubs','contacts','user-agreement','policy','login', 'clubs-offers', 'cities', 'registration'];
    return view('about.sitemap')->with(['posts'=>$posts,'cities'=>$cites,'clubs'=>$clubs,'otherLinks'=>$otherLinks]);
  }
  public function redirectToCity(){
    return redirect('computerniy_club_moskva');
  }
  public function redirectOldCitiesURLs($city){
    // проверяю, $city это точно адрес города?
    $city=city::where('en_name',$city)->select('id','en_name')->firstOrFail();
    return redirect('/computerniy_club_'.$city->en_name);
  }

  public function langame_software(){
    return view('about.langame_software');
  }
  public function redirect_to_software(){
    return redirect('/software');
  }

  public function contacts(){
    return view('about.contacts');
  }
  public function policy(){
    return view('about.policy');
  }
  public function user_agreement(){
    return view('about.user_agreement');
  }
  public function about_us(){
    return view('about.about_us');
  }
}
