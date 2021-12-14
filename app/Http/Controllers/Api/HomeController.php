<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\post;
use App\club;
use App\city;
use App\metro;
use DateTime;
use Carbon\Carbon;
use DB;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getClubs($request,true);
        $posts = post::select('id','url','image','name','about')->orderBy('order_no','desc')->orderBy('created_at','desc')->limit(3)->get();
        foreach ($posts as $post) {
          $post->image = ($post->image != '') ? url('storage/posts/thumbnail/'.$post->image) : asset('img/default-club-preview-image.svg');
          $post->about=\Illuminate\Support\Str::limit(strip_tags($post->about),200, '...');
          
        }
        $data['posts'] =$posts ;
        $data['hasMorePosts'] = (post::count() > 3 )? true : false;
        $data['cities']= $this->searchCities($request,true);
        $data['current_city']=city(true);
        $data['status']=true;
        return response()->json($data, 202);
    }
   public function getClubs(Request $request,$forIndex = false){
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
     foreach($clubs as $club){
      if($club->closed == '1'){
        $openStatus = 'closedAlways';
      }else{
        $openStatus = 'open';
        if ($club->work_time == '2') {
          $schedule_item = unserialize($club->work_time_days);
        }
        if ($club->work_time == '2' && is_array($schedule_item)) {
            if (!isset($schedule_item[strtolower($today)])) {
                $openStatus = 'closed';
            } else {
                if (!empty($schedule_item[strtolower($today)]['from']) && !empty($schedule_item[strtolower($today)]['to'])) {
                    $now = new DateTime();
                    $begin = new DateTime($schedule_item[strtolower($today)]['from']);
                    if (explode(":", $schedule_item[strtolower($today)]['to'])[0] < explode(":", $schedule_item[strtolower($today)]['from'])[0]) {
                        $end = new DateTime($schedule_item[strtolower($today)]['to']);
                        $end->add(new \DateInterval("P1D"));
                    } else {
                        $end = new DateTime($schedule_item[strtolower($today)]['to']);
                    }
                    if ($now >= $begin && $now <= $end) {
                        $openStatus = 'open';
                    } else {
                        $openStatus = 'closed';
                    }
                }
            }
        }
      }
      $club->openStatus = $openStatus;
     }
     unset($club->work_time_days,$schedule_item);
     if($forIndex)
     return ['clubs'=>$clubs,'now'=>$now,'today'=>$today ];
     return response()->json(['status'=>true,'clubs'=>$clubs,'now'=>$now,'today'=>$today ], 202);

   }

     public function searchCities(Request $request,$forIndex = false){
      $b = array();
      if($request->input('hasAll') && $request->input('hasAll') == 'true'){
          $b["results"][]=[ "text"=>'Все города', "data"=> 'all','id'=>'all' ,'has_metro' => 'false'];
      }
      if(($request->input('q'))){
        $cities=city::select('id','name','metroMap','parentName')->where('name', 'like', $request->input('q') . '%')->orWhere('en_name', 'like', $request->input('q') . '%')->orderBy('order_no')->paginate(8);
        if($cities->total() == 0){
          $now =Carbon::now()->toDateTimeString();
          $cities_searchs =DB::statement('insert into cities_searchs (query,created_at,updated_at) values ("'.$request->input('q').'","'.$now.'","'.$now.'")');
        }
      }else{
        $correntCity = city::select('id','name','metroMap','parentName','namePrepositional','lat','lon')->find(($request->input('current') ? $request->input('current') : city(true)['id']));
        if(!isset($request->page) || $request->page == 1){
          $b["results"][]=[ "name" => $correntCity->name, "text"=> ($correntCity->parentName != '') ? $correntCity->name.', '.$correntCity->parentName :  $correntCity->name,'id'=>$correntCity->id ,'has_metro' =>  $correntCity->metroMap,'namePrepositional'=>$correntCity->namePrepositional,'lat'=>$correntCity->lat,'lon'=>$correntCity->lon];
          $b['status']=true;
        return response()->json($b, 202);
        }
        $cities=city::select('id','name','metroMap','parentName')->where('id','!=',$correntCity->id)->orderBy('order_no')->paginate(8);
      }
      if($cities->lastPage() > $cities->currentPage() ){
        $b["hasMore"]= true;
      }else{
        $b["hasMore"]= false;
      }
      foreach ($cities as $city) {

       $b["results"][]=[ "name" => $city->name,"text"=> ($city->parentName != '') ? $city->name.', '.$city->parentName :  $city->name,'id'=>$city->id,'has_metro' =>  $city->metroMap  ];
      }
      if($forIndex)return $b["results"];
      $b['status']=true;
        return response()->json($b, 202);
   }
}