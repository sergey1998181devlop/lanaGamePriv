<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Str;
use App\club;
use DateTime;
use Carbon\Carbon;
include_once(resource_path('views/includes/functions.blade.php')); 
class clubsController extends Controller
{
    public function index($id,Request $request){
        $lon = ($request->input('lon')) ? $request->input('lon') : 0;
        $lat =($request->input('lat')) ? $request->input('lat') : 0 ;
        $club = club::where('id',$id)->select('*', club::raw('round(1.6 * ( 3959 * acos( cos( radians("'.$lat.'") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians("'.$lon.'") ) + sin( radians("'.$lat.'") ) * sin( radians( lat ) ) ) ),1) AS nearby'))->where('draft','0')->with(array('city' => function($query) {
            $query->select('id','name', 'en_name');
        },'metro'=>function($query) {
            $query->select('id','name','color');
        }))->first();
        if(!$club){
            return response()->json(['status'=>false,'msg'=>'non_found'], 202);
        }
        if($club->published_at == null || $club->hidden_at != null ){
            if(Auth::guest() || $club->user_id != Auth::user()->id){
                return response()->json(['status'=>false,'msg'=>'non_found'], 202);
            }
        }

        $views=$club->views;
        $views++;
        $club->views=$views;
        $club->save();

        $now = new DateTime();
        $today = strtolower(date("l"));
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

          

        return response()->json(['status'=>true,'club'=>$club], 202);
    }
     
}
