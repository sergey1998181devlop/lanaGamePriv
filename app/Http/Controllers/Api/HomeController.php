<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\post;
use App\club;
use App\city;
use App\metro;
use DateTime;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getClubs($request);
        $data['posts'] =post::select('id','url','image','name','about')->orderBy('order_no','desc')->orderBy('created_at','desc')->limit(3)->get();
        $data['hasMorePosts'] = (post::count() > 3 )? true : false;
        $data['cities']= $this->searchCities($request,true);
        $data['status']=true;
        return response()->json($data, 202);
    }
   public function getClubs(Request $request){
    cityApi($request->input('city')); //сохранить город в сессию
    if (empty($_GET["lat"]) && empty($_GET['lon'])){
      $api_yandex = new \Yandex\Locator\Api('AP2BymABAAAAAqumUgIAzSJaePpJPDsATaQ5CtyPNtLdC60AAAAAAAAAAABVXZbOLoQ1EhZSTVkNehJDKsp9Dg==');
      $api_yandex->setIp($_SERVER['REMOTE_ADDR']);
      $lat = '';
      $lon = '';
      try {
          $api_yandex->load();
          $response = $api_yandex->getResponse();
          $lat = $response->getLatitude();
          $lon = $response->getLongitude();
      } catch (\Yandex\Locator\Exception\CurlError $ex) {
          // ошибка curl
      } catch (\Yandex\Locator\Exception\ServerError $ex) {
          // ошибка Яндекса
      } catch (\Yandex\Locator\Exception $ex) {
          // какая-то другая ошибка (запроса, например)
      }

    }else{
      $lat = $_GET["lat"];
      $lon = $_GET["lon"];
    }

    $order = 'club_min_price';
    $order_key='ASC';
    if($request->input('order') == 'nearby'){
      $order = 'nearby';
      $getAll = false;

    }elseif ($request->input('order') == 'rating') {
      $order = 'rating';
      $order_key='DESC';
    }
    if ($request->input('order_key') == "desc"){
      $order_key = "DESC";
    }
    if ($request->input('order_key') == "asc"){
      $order_key = "ASC";
    }
    $paginate = 9;
    if ($request->input('show') == "map"){
      $paginate = 999999999999999; // показать все
    }
    if (!empty($request->input('search'))){
      $search_string = $request->input('search');
    }else{
      $search_string = "";
    }
    if($order == 'nearby'){
        if ($request->input('show') == "map"){
            $clubs= club::SelectCartFeilds4Home($lat, $lon)->Published()->whereNull('hidden_at')->with(array('metro'=>function($query) {
              $query->select('id','name','color');
            },'city'=>function($query) {
              $query->select('id','name');
            }))->orderBy($order,$order_key)->paginate($paginate);
        }else{
            $clubs= club::SelectCartFeilds4Home($lat, $lon)->Published()->CorrentCity($request->input('city'))->whereNull('hidden_at')->with(array('metro'=>function($query) {
              $query->select('id','name','color');
            }))->orderBy($order,$order_key)->paginate($paginate);
        }


    }else{

          if ($request->input('show') == "map"){
            $clubs= club::SelectCartFeilds4Home($lat, $lon)->Published()->whereNull('hidden_at')->where('club_name', 'like', '%'.$search_string.'%')->with(array('metro'=>function($query) {
              $query->select('id','name','color');
            },'city'=>function($query) {
              $query->select('id','name');
            }))->orderBy($order,$order_key)->paginate($paginate);
          }else{
            $clubs= club::SelectCartFeilds4Home($lat, $lon)->Published()->CorrentCity($request->input('city'))->whereNull('hidden_at')->where('club_name', 'like', '%'.$search_string.'%')->with(array('metro'=>function($query) {
              $query->select('id','name','color');
            }))->orderBy($order,$order_key)->paginate($paginate);
          }

    }
     $now = new DateTime();
     $today = strtolower(date("l"));

     return ['clubs'=>$clubs,'now'=>$now,'today'=>$today ];
   }
    public function searchCities(Request $request,$forIndex = false){
        $b = array();
        if(($request->input('q'))){
          $cities=city::select('id','name','en_name','metroMap','parentName')->where('name', 'like', '%' . $request->input('q') . '%')->orWhere('en_name', 'like', '%' . $request->input('q') . '%')->orderBy('order_no')->paginate(8);
        }else{
          $correntCity = city::select('id','name','en_name','metroMap','parentName')->find(($request->input('selected') ? $request->input('selected') : city(true)['id']));
          if(!isset($request->page) || $request->page == 1){
            $b["results"][]=[ "text"=> $correntCity->name, "data"=> $correntCity->en_name,'id'=>$correntCity->id ,'has_metro' =>  $correntCity->metroMap ];
          }
          $cities=city::select('id','name','en_name','metroMap','parentName')->where('id','!=',$correntCity->id)->orderBy('order_no')->paginate(8);
        }
        if($cities->lastPage() > $cities->currentPage() ){
          $b["pagination"]= [
            "more"=> true
          ];
        }
        foreach ($cities as $city) {
  
         $b["results"][]=[ "text"=> ($city->parentName != '') ? $city->name.', '.$city->parentName :  $city->name, "data"=> $city->en_name,'id'=>$city->id,'has_metro' =>  $city->metroMap  ];
        }
        if($forIndex)return $b["results"];
        return response($b);
     }
}