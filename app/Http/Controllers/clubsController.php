<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\club;
use App\User;
use Auth;
use Carbon\Carbon;
include_once(resource_path('views/includes/functions.blade.php'));
class clubsController extends Controller
{
    public $isDraft;
    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->isDraft = false;
    }
    public function index($id){
        $club = club::where('id',$id)->where('draft','0')->first();
        if(!$club)abort(404);
        if($club->published_at == null || $club->hidden_at != null ){
            if(!admin() || $club->user_id != Auth::user()->id){
                abort(404);
            }
            $comments = $club->comments;
            if(count($comments) > 0)
            return view('clubs.club')->with(['club'=>$club,'comments'=>$comments ]);
        }
        
        return view('clubs.club')->with(['club'=>$club]);
    }
    public function toggle($id){
        $club = club::select('id','user_id','published_at','hidden_at','draft')->where('id',$id)->CorrentUser()->Published()->first();
        if(!$club)abort(404);
        $club->hidden_at = ($club->hidden_at == null) ? Carbon::now()->toDateTimeString() : null;
        $club->save();
    }
    public function edit($id){
        global $clubAr;
        $clubAr = club::CorrentUser()->findOrFail($id);
        $published = club::SelectCartFeilds()->CorrentUser()->Published()->get();
        $underModify = club::SelectCartFeilds()->CorrentUser()->UnderEdit()->get();
        $draft = club::SelectCartFeilds()->CorrentUser()->Draft()->get();

        return view('personal/club_list')->with(['action'=>'edit','clubAr'=>$clubAr,'published'=>$published,'underModify'=>$underModify,'draft'=>$draft]);
    }
    public function clubs(){
        $published = club::SelectCartFeilds()->CorrentUser()->Published()->get();
        $underModify = club::SelectCartFeilds()->CorrentUser()->UnderEdit()->get();
        $draft = club::SelectCartFeilds()->CorrentUser()->Draft()->get();
        return view('personal/club_list')->with(['published'=>$published,'underModify'=>$underModify,'draft'=>$draft]);
    }
    public function inputsTextsHandle(){
        return [
            'club_name',
            'club_city',
            'phone',
            'club_address',
            'club_metro',
            'club_area',
            'qty_pc',
            'club_min_price',
            'club_site',
            'club_email',
            'club_link',
            'club_vk_link',
            'club_instagram_link',
            'club_description',
            'club_youtube_link',
            'club_photos',
            'main_preview_photo'
        ];
    }
    public function servicesHandle(){
        return [
            'hookah',
            'streamer',
            'alcohol',
            'with_own_device',
            'bathroom',
            'club_account',
            'checkroom',
            'download_app',
            'conditioner',
            'smoke',
            'print',
            'with_own_food',
        ];
    }

    public function addClub(Request $request){
        return $this->store($request);
    }
    public function addDraftClub(Request $request){
        $this->isDraft = true;
        if($this->store($request)){
            return response()->json('success',202);
        }
        return response()->json('error',402);

    }
    
    public function store($request){
       $club = new club();
       $club->user_id=Auth::user()->id;
       foreach($this->inputsTextsHandle() as $input){
           if($request->input($input) == '')continue;
            $club->$input = $request->input($input);
       }
       if($this->isDraft){
           $club->draft = '1';
       }
       if($request->input('vip_pc') == 'on')
            $club->qty_vip_pc = $request->input('qty_vip_pc');
       if($request->input('vr') == 'on')
            $club->qty_vr = $request->input('qty_vr');
       if($request->input('simulator') == 'on')
            $club->qty_simulator = $request->input('qty_simulator');

       if($request->input('console') == 'on'){
            $club->console = '1';
            $club->console_type = $request->input('console_type');
            $club->qty_console = $request->input('qty_console');
        }
        if($request->input('food_drinks') == 'on'){
            $club->food_drinks = '1';
            $club->food_drink_type = $request->input('food_drink_type');
        }

        foreach($this->servicesHandle() as $input){
            if($request->input($input) == 'on')
             $club->$input = '1';
        }

        if($request->input('work_time') == 'not-24/7'){
            $club->work_time = '2';
            $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            $daysAr=[];
            foreach ($days as $day) {
                if($request->input($day) == 'on'){
                    $daysAr[$day]['from'] = $request->input($day.'_work_from');
                    $daysAr[$day]['to'] = $request->input($day.'_work_to');
                }
            }
            if(count($daysAr) > 0)
            $club->work_time_days = serialize($daysAr);
        }
        if($request->input('club_price_file') != ''){
            $club->club_price_file = $request->input('club_price_file') ;
        }
        $club->configuration = serialize($request->input('configuration'));
        if($request->input('marketing_event') == 'on'){
            $club->marketing_event = '1';
            $club->marketing_event_descr = serialize($request->input('marketing_event_descr'));
        }
        $payment_methods = [];
        $payment_ways=[
            'payment_cash',
            'payment_cards',
            'payment_online',
            'payment_web_wallet',
            'payment_account_number'
        ];
        foreach($payment_ways as $input){
            if($request->input($input) == 'on')
            $payment_methods[]=$input;
        }
        if(count($payment_methods) > 0)
        $club->payment_methods = implode(',',$payment_methods);
        $club->url=ucwords(str_replace(" ","-",$request->input('club_name')));
       if($club->save()){
           return true;
       }
       return false;
    }
    public function saveImage(Request $request){
    
        $message = $url = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->isValid()) {
                $uniqie=time().uniqid();
                $filename = $uniqie.preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(storage_path('app/public/clubs/images/'), $filename);
                $url = url('storage/clubs/images').'/'. $filename;
                return response()->json(['data'=>$url]);
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        
        return response()->json(['uploaded' => '0', "error"=> [
            "message"=> "An error occured while uploading the file."]
        ]);
     
    }
    public function savePriceList(Request $request){
    
        $message = $url = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->isValid()) {
                $uniqie=time().uniqid();
                $filename = $uniqie.preg_replace('/\s+/', '_', $file->getClientOriginalName()) ;
                $file->move(storage_path('app/public/clubs/lists'), $filename);
                $url = url('storage/clubs/lists').'/'. $filename;
                return response()->json(['data'=>$url]);
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        
        return response()->json(['uploaded' => '0', "error"=> [
            "message"=> "An error occured while uploading the file."]
        ]);
     
    }
}