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
            $query->select('id','name');
        },'metro'=>function($query) {
            $query->select('id','name','color');
        }))->first()->makeHidden(['draft','url','created_at','club_thumbnail','deleted_at','deleted_by','unpublished_at','unpublished_by','published_by','last_admin_edit']);
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
        $club->timestamps = false;
        $club->save();
        // club status
        $now = new DateTime();
        $today = strtolower(date("l"));
        if($club->closed == '1'){
            $openStatus = 'closedAlways';
          }else{
            $openStatus = 'open';
            if ($club->work_time == '2') {
              $schedule_item = unserialize($club->work_time_days);
              $club->work_time_days =$schedule_item;
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
        // club video
        $youtubeVideoUrl = null;
        $youtubeImageUrl = null;

        if (\preg_match('#^https://youtu\.be/(.+)#', $club->club_youtube_link ?: '', $matches)) {
            $youtubeVideoUrl = "https://www.youtube.com/embed/{$matches[1]}";
            $youtubeImageUrl = "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg";
        } elseif (\preg_match('#^https://www\.youtube\.com/watch\?v=(.+)#', $club->club_youtube_link ?: '', $matches)) {
            $youtubeVideoUrl = "https://www.youtube.com/embed/{$matches[1]}";
            $youtubeImageUrl = "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg";
        }
        if($youtubeVideoUrl && $youtubeImageUrl){
            $club->video = ['url'=>$youtubeVideoUrl,'image'=>$youtubeImageUrl];

        }
        // club images
        $images=array_filter(explode(',', $club->club_photos));
        if (($key = array_search($club->main_preview_photo, $images)) !== false) {
            unset($images[$key]);
        }
        array_unshift($images,$club->main_preview_photo);
        $club->club_photos = $images;
        unset($club->main_preview_photo,$club->club_youtube_link,$youtubeVideoUrl,$youtubeImageUrl,$club->club_city,$club->club_metro);
        // Услуги
        $services = [];
        $message = msgfmt_create('ru_RU', '{count, plural, one{# компьютер} few{# компьютера} many{# компьютеров} other{# компьютера}}');
        $services['qty_pc'] = $message->format(['count' => $club->qty_pc]);

        if($club->console == '1'){
            $message = msgfmt_create('ru_RU', '{count, plural, one{# консоль} few{# консоли} many{# консолей} other{# консоли}}');
            $count_cons = $club->qty_console + $club->qty_console_1 + $club->qty_console_2 + $club->qty_console_3;
            $cons_types = implode(', ',array_unique(array_filter([$club->console_type,$club->console_type_1,$club->console_type_2,$club->console_type_3])));
            $services['consoles'] = $message->format(['count' => $count_cons]).' '.$cons_types;
        }
        if($club->qty_vip_pc > 0){
            $message = msgfmt_create('ru_RU', '{count, plural, one{# компьютер} few{# компьютера} many{# компьютеров} other{# компьютера}}');
            $services['qty_vip_pc'] = $message->format(['count' => $club->qty_vip_pc]);
        }
        if($club->qty_simulator > 0){
            $message = msgfmt_create('ru_RU', '{count, plural, one{# устройство} few{# устройства} many{# устройств} other{# устройства}}');
            $services['qty_simulator'] = $message->format(['count' => $club->qty_simulator]);
        }
        if($club->qty_vr > 0){
            $message = msgfmt_create('ru_RU', '{count, plural, one{# устройство} few{# устройства} many{# устройств} other{# устройства}}');
            $services['qty_vr'] = $message->format(['count' => $club->qty_vr]);
        }
        if($club->food_drinks == '1'){
            $services['food_drinks'] = $club->food_drink_type;
        }
        $services['other'] = [
            'hookah' => ($club->hookah == '1') ? true : false,
            'alcohol' => ($club->alcohol == '1') ? true : false,
            'bathroom' => ($club->bathroom == '1') ? true : false,
            'checkroom' => ($club->checkroom == '1') ? true : false,
            'conditioner' => ($club->conditioner == '1') ? true : false,
            'print' => ($club->print == '1') ? true : false,
            'streamer' => ($club->streamer == '1') ? true : false,
            'club_account' => ($club->club_account == '1') ? true : false,
            'download_app' => ($club->download_app == '1') ? true : false,
            'smoke' => ($club->smoke == '1') ? true : false,
            'with_own_device' => ($club->with_own_device == '1') ? true : false,
            'with_own_food' => ($club->with_own_food == '1') ? true : false,
            'tsena' => ($club->tsena == '1') ? true : false,            
        ];
        $club->services = $services;
        unset($club->qty_pc,$club->console,$club->qty_vip_pc,$club->qty_simulator,$club->qty_vr,$club->food_drinks,$club->hookah,$club->alcohol,$club->alcohol,$club->bathroom,$club->checkroom,$club->conditioner,$club->print,$club->streamer,$club->club_account,$club->download_app,$club->smoke,$club->with_own_device,$club->with_own_food,$club->tsena,$club->qty_console,$club->qty_console_1,$club->qty_console_2,$club->qty_console_3,$club->console_type,$club->console_type_1,$club->console_type_2,$club->console_type_3,$club->food_drink_type,$club->closed);

        // configirations
        if(canBeUnserialized($club->configuration)){
            $club_configuration =[];
            foreach ( unserialize($club->configuration) as $key => $value) {
                $club_configuration[] = $value;
            }
            $club->configuration = $club_configuration;
        }else{
            $club->configuration = '';
        }
        // акции
        if($club->marketing_event == '1' && canBeUnserialized($club->marketing_event_descr)){
            $club->marketing_event = unserialize($club->marketing_event_descr);
            
        }else{
            $club->marketing_event = null;
        }
        unset($club->marketing_event_descr);
        $payment_list = array_filter(explode(',', $club->payment_methods));
        foreach ($payment_list as $value) {
           $payment_list_ar[] =  __('messages.'.$value);
        }
        $club->payment_methods = $payment_list_ar;
        return response()->json(['status'=>true,'club'=>$club], 202);
    }
     
}
