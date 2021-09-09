<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\club;
use App\User;
use Auth;
use Carbon\Carbon;
use ImageResize;
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
        $lon = isset($_COOKIE['lon']) ? $_COOKIE['lon'] : 0;
        $lat =isset($_COOKIE['lat']) ? $_COOKIE['lat'] : 0 ;
        $club = club::where('id',$id)->select('*', club::raw('round(1.6 * ( 3959 * acos( cos( radians("'.$lat.'") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians("'.$lon.'") ) + sin( radians("'.$lat.'") ) * sin( radians( lat ) ) ) ),1) AS nearby'))->where('draft','0')->with(array('city' => function($query) {
            $query->select('id','name');
        },'metro'=>function($query) {
            $query->select('id','name','color');
        }))->withTrashed()->first();
        if(!$club)abort(404);
        if($club->deleted_at!= null && !admin())abort(404);
        if($club->published_at == null || $club->hidden_at != null ){
            if(Auth::guest())abort(404);
            if(!admin() && $club->user_id != Auth::user()->id){
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
        if(admin()){
            $clubAr = club::withTrashed()->findOrFail($id);
        }else{
            $clubAr = club::CorrentUser()->findOrFail($id);
        }

        $published = club::SelectCartFeilds()->CorrentUser()->Published()->get();
        $underModify = club::SelectCartFeilds()->CorrentUser()->UnderEdit()->get();
        $draft = club::SelectCartFeilds()->CorrentUser()->Draft()->get();

        return view('personal/club_list')->with(['action'=>'edit','clubAr'=>$clubAr,'published'=>$published,'underModify'=>$underModify,'draft'=>$draft]);
    }
    public function clubs(){
        $published = club::SelectCartFeilds()->CorrentUser()->Published()->with(array('metro'=>function($query) {
            $query->select('id','name','color');
        }))->get();
        $underModify = club::SelectCartFeilds()->CorrentUser()->UnderEdit()->with(array('metro'=>function($query) {
            $query->select('id','name','color');
        }))->get();
        $draft = club::SelectCartFeilds()->CorrentUser()->Draft()->with(array('metro'=>function($query) {
            $query->select('id','name','color');
        }))->get();
        return view('personal/club_list')->with(['published'=>$published,'underModify'=>$underModify,'draft'=>$draft]);
    }
    public function inputsTextsHandle(){
        return [
            'club_name',
            'club_city',
            'phone',
            'club_address',
            'club_full_address',
            'club_metro',
            'club_site',
            'club_email',
            'club_link',
            'club_vk_link',
            'club_instagram_link',
            'club_description',
            'club_youtube_link',
            'club_photos',
            'club_price_file',
            'lon',
            'lat'
        ];
    }
    public function inputsNumersHandle(){
        return [
            'qty_pc',
            'club_min_price',
            'club_area',
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
        if($this->store($request)){
            return response()->json('success',202);
        }
        return response()->json('error',402);
    }
    public function addDraftClub(Request $request){
        $this->isDraft = true;
        if($this->store($request)){
            return response()->json('success',202);
        }
        return response()->json('error',402);

    }
    public function update($id,Request $request){
        if($this->store($request,true,$id)){
            return response()->json('success',202);
        }
        return response()->json('error',402);
    }
    public function updateDraft($id,Request $request){
        $this->isDraft = true;
        if($this->store($request,true,$id)){
            return response()->json('success',202);
        }
        return response()->json('error',402);
    }

    public function store($request,$update = false,$id= null){
        // validation
        if(!admin() && !$this->isDraft){
            $data = $request->validate([
                'club_name' => ['required'],
                'club_city' => ['required'],
                'phone' => ['required'],
                'club_address' => ['required'],
                'club_photos' => ['required'],
                'lon' => ['required'],
                'lat' => ['required'],
                'qty_pc' => ['required'],
                'club_min_price' => ['required'],
                'work_time' => ['required'],
                'configuration' => ['required'],
            ]);
        }
        $validationAr = [];
        $errors = [];
        if($update){
            if(admin()){
                $club = club::withTrashed()->findOrFail($id);
            }else{
                $club = club::CorrentUser()->findOrFail($id);
                $club->published_at = null;
                $club->published_by = 0;
                $club->unpublished_at = Carbon::now()->toDateTimeString();
                $club->unpublished_by = Auth::user()->id;
            }
            if(!$this->isDraft && $club->draft == '1'){
                $club->draft = '0';
                $club->created_at =Carbon::now()->toDateTimeString();
            }

        }else{
            $club = new club();
            $club->user_id=Auth::user()->id;
        }
        if(admin()){
            $club->last_admin_edit =Auth::user()->id;
        }
        if($this->isDraft){
            $club->draft = '1';
        }elseif(notVerifed()){
            return false;
        }
        if(admin() && !$this->isDraft){
            $club->rating = $request->input('rating');
        }
       foreach($this->inputsTextsHandle() as $input){
           if($request->input($input) == ''){ $club->$input = '';continue;}
            $club->$input = $request->input($input);
       }
        foreach($this->inputsNumersHandle() as $input){
            if($request->input($input) == ''){ $club->$input = 0;continue;}
            $club->$input = $request->input($input);
        }
        if($request->input('vip_pc') == 'on'){
            $club->qty_vip_pc = $request->input('qty_vip_pc');
            $validationAr['qty_vip_pc'] = ['required','numeric','min:1'];
        }
        else{
            $club->qty_vip_pc = 0;
        }
        if($request->input('vr') == 'on'){
            $club->qty_vr = $request->input('qty_vr');
            $validationAr['qty_vr'] = ['required','numeric','min:1'];
        }else{
            $club->qty_vr = 0;
        }

        if($request->input('simulator') == 'on'){
            $club->qty_simulator = $request->input('qty_simulator');
            $validationAr['qty_simulator'] = ['required','numeric','min:1'];
        }else{
            $club->qty_simulator = 0;
        }
       if($request->input('console') == 'on'){
            $club->console = '1';
            $club->console_type = $request->input('console_type');
            $club->qty_console = $request->input('qty_console');
            $validationAr['qty_console'] = ['required','numeric','min:1'];
            $validationAr['console_type'] = ['required'];
        }else{
            $club->console = '0';
            $club->console_type = '0';
            $club->qty_console = 0;
        }
        if($request->input('food_drinks') == 'on'){
            $club->food_drinks = '1';
            $club->food_drink_type = $request->input('food_drink_type');
            $validationAr['food_drink_type'] = ['required'];
        }else{
            $club->food_drinks = '0';
            $club->food_drink_type = '';
        }

        foreach($this->servicesHandle() as $input){
            if($request->input($input) == 'on'){
                $club->$input = '1';
            }else{
                $club->$input = '0';
            }
        }

        if($request->input('work_time') == 'not-24/7'){
            $club->work_time = '2';
            $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            $daysAr=[];
            foreach ($days as $day) {
                if($request->input($day) == 'on'){
                    $daysAr[$day]['from'] = $request->input($day.'_work_from');
                    $daysAr[$day]['to'] = $request->input($day.'_work_to');
                    if($request->input($day.'_work_from') == '' || $request->input($day.'_work_to')){
                        $errors[] = 'work_time';
                    }
                }
            }
            if(count($daysAr) > 0){
                $club->work_time_days = serialize($daysAr);
            }else{
                $errors[] = 'work_time';
            }

        }else{
            $club->work_time = '1';
            $club->work_time_days = '';
        }
        $club->configuration = serialize($request->input('configuration'));
        if(!is_array($request->input('configuration'))) $errors[] = 'configuration';
        if($request->input('marketing_event') == 'on'){
            $club->marketing_event = '1';
            $club->marketing_event_descr = serialize($request->input('marketing_event_descr'));
            if(!is_array($request->input('marketing_event_descr'))) $errors[] = 'marketing_event';
        }else{
            $club->marketing_event = '0';
            $club->marketing_event_descr = '';
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
        if(count($payment_methods) == 0) $errors[] = 'payment_methods';
        $club->payment_methods = implode(',',$payment_methods);
        $club->url=$this->clean($request->input('club_name'));

        if($club->main_preview_photo != $request->input('main_preview_photo')){
            $club->club_thumbnail = '';
            $filename = explode('clubs/images/',$request->input('main_preview_photo'));
            if(isset($filename[1])){
                $filename=$filename[1];
                if(file_exists(storage_path('app/public/clubs/images/'.$filename))){
                    $infoPath = pathinfo(storage_path('app/public/clubs/images/'.$filename));
                    $extension = $infoPath['extension'];
                    if($extension != 'jfif' &&  $extension != 'HEIC'){
                        $destinationPath = storage_path('app/public/clubs/thumbnail');
                            $img = ImageResize::make(storage_path('app/public/clubs/images/'.$filename));
                            $img->resize(300,'auto', function ($constraint) {
                                $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename);
                        $club->club_thumbnail =  url('storage/clubs/thumbnail').'/'. $filename;
                    }
                }
            }
        }

        $club->main_preview_photo = $request->input('main_preview_photo');
        if(!admin() && !$this->isDraft){
            $data = $request->validate($validationAr);
            if(count($errors) > 0) {
                return false;}
        }
       if($club->save()){
           return true;
       }
       return false;
    }
    public function saveImage(Request $request){
        $data = $request->validate([
            'file' => ['required', 'image','max:5500'],
        ]);
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
    public function clean($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9-ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮйцукенгшщзхфывапролджэячсмитьбю]/', '', $string);
    }
    public function savePriceList(Request $request){
        $data = $request->validate([
            'file' => ['required', 'mimes:jpg,bmp,png,pdf','max:5500'],
        ]);
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
