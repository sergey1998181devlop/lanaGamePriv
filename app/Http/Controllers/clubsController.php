<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\club;
use App\User;
use Auth;
use Carbon\Carbon;
use ImageResize;
use Str;
use App\liked_club;
use Illuminate\Support\Facades\Validator;
include_once(resource_path('views/includes/functions.blade.php'));
class clubsController extends Controller
{
    public $isDraft;
    public $club_id;
    public function __construct()
    {
        $this->middleware('owner',['except' => ['index','redirectOldClubsURLS','likeClub','unLikeClub']]);        
        $this->middleware('player',['only' => ['likeClub','unLikeClub']]);
        $this->isDraft = false;
    }
    public function index($id, $url, $city){
        $lon = isset($_COOKIE['lon']) ? $_COOKIE['lon'] : 0;
        $lat =isset($_COOKIE['lat']) ? $_COOKIE['lat'] : 0 ;
        $club = club::where('id',$id)->select('*', club::raw('round(1.6 * ( 3959 * acos( cos( radians("'.$lat.'") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians("'.$lon.'") ) + sin( radians("'.$lat.'") ) * sin( radians( lat ) ) ) ),1) AS nearby'))->where('draft','0')->with(array('city' => function($query) {
            $query->select('id','name', 'en_name');
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
        if ($url != Str::slug($club->url) || $city != $club->city->en_name){
            return redirect($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name);
        }
        $views=$club->views;
        $views++;
        $club->views=$views;
        $club->save();

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
        },
        'city' => function($query) {
            $query->select('id','en_name');
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
            'tsena',
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
            return response()->json(['status'=>'success','club_id'=>$this->club_id],202);
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
        $club->console = '0';
        $club->console_type = null;
        $club->qty_console = 0;
        $club->console_type_1 = null;
        $club->qty_console_1 = 0;
        $club->console_type_2 = null;
        $club->qty_console_2 = 0;
        $club->console_type_3 = null;
        $club->qty_console_3 = 0;
       if($request->input('console') == 'on'){
            $club->console = '1';
            foreach ($request->input('console_type') as $key => $value) {
                if(!isset($consX)){
                    $club->console_type =  $value;
                    $club->qty_console =  $request->input('qty_console')[$key] ? $request->input('qty_console')[$key] : 0;
                    $consX = 1;
                }else{
                    $cName = 'console_type_'.$consX;
                    $qtyName = 'qty_console_'.$consX;
                    $club->$cName =  $value;
                    $club->$qtyName =  $request->input('qty_console')[$key] ? $request->input('qty_console')[$key] : 0 ;
                    $consX++;
                }
                if($consX == 4) break;
            }
            $validationAr['qty_console'] = ['required'];
            $validationAr['console_type'] = ['required'];
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
                    if($request->input($day.'_work_from') == '' || $request->input($day.'_work_to') == ''){
                        $errors['work_time'] = [
                            'График работы заполнен неверно'
                        ];
                    }
                }
            }
            if(count($daysAr) > 0){
                $club->work_time_days = serialize($daysAr);
            }else{
                $errors['work_time'] = [
                    'График работы заполнен неверно'
                ];
            }

        }else{
            $club->work_time = '1';
            $club->work_time_days = '';
        }
        
        if(!is_array($request->input('configuration'))){
            
            $errors['configuration'] = [
                'Конфигурация оборудования заполнена неверно'
            ];
        }else{
            $configuration = $request->input('configuration');
            foreach ($configuration as $key=> $zone) {
                // дюймы и герцы вместе
                $type = isset($configuration[$key]['monitor_type']) ? $configuration[$key]['monitor_type'] : '';
                $hertz = isset($configuration[$key]['monitor_hertz']) ? $configuration[$key]['monitor_hertz'] .' Гц' : '';
                unset($configuration[$key]['monitor_hertz']);
                $configuration[$key]['monitor_type']=$type . ' ' .$hertz;
           }
            $club->configuration = serialize($configuration);
        }
        if($request->input('marketing_event') == 'on'){
            $club->marketing_event = '1';
            $club->marketing_event_descr = serialize($request->input('marketing_event_descr'));
            if(!is_array($request->input('marketing_event_descr'))){
                $errors['marketing_event'] = [
                    'Акции заполнены неверно'
                ];
            } 
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
        if(count($payment_methods) == 0){
            $errors['payment_methods'] = [
                'способы оплаты заполнены неверно'
            ];
        }
        $club->payment_methods = implode(',',$payment_methods);
        $club->url=$this->clean($request->input('club_name'));
        if($club->main_preview_photo != $request->input('main_preview_photo')){
            
            $club->club_thumbnail = '';
            $filename = explode('clubs/',$request->input('main_preview_photo'));
            if(isset($filename[1])){
               
                $filename=$filename[1];
                if(file_exists(storage_path('app/public/clubs/'.$filename))){
                    $infoPath = pathinfo(storage_path('app/public/clubs/'.$filename));
                    $subPath = date("Y").'/'.date("M").'/'.date("d");
                    if (!file_exists(storage_path('app/public/clubs/thumbnail/'.$subPath))) {
                        mkdir(storage_path('app/public/clubs/thumbnail/'.$subPath), 0777, true);
                    }
                    if($infoPath['extension'] != 'jfif' &&  $infoPath['extension'] != 'HEIC'){
                        $destinationPath = storage_path('app/public/clubs/thumbnail/'.$subPath);
                            $img = ImageResize::make(storage_path('app/public/clubs/'.$filename));
                            $img->resize(300,'auto', function ($constraint) {
                                $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$infoPath['basename']);
                        $club->club_thumbnail =  url('storage/clubs/thumbnail').'/'.$subPath.'/'. $infoPath['basename'];
                    }
                }
            }
        }
        $club->main_preview_photo = $request->input('main_preview_photo');
        if(!admin() && !$this->isDraft){
            $data = $request->validate($validationAr);
            if(count($errors) > 0) {
                jsonValidationException($errors);
            }
        }
       if($club->save()){
            $this->club_id = $club->id;
           return true;
       }
       
       header('Content-type: application/json');
       \http_response_code(422);
       echo json_encode(['error'=>'Ошибка! обратитесь к администратору']);
       exit();
    }
    public function saveImage(Request $request){
       $this->imageSaver($request,'clubs');
    }
    public function savePriceList(Request $request){
        $this->imageSaver($request,'clubs/lists');
    }
    public function imageSaver(Request $request,$folder = 'clubs'){
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'image','max:5500']
        ]);
        if ($validator->fails()) {
            jsonValidationException(['file' => $validator->errors()->first()]);
        }
        $message = $url = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->isValid()) {
                $uniqie=time().uniqid();
                $filename = $uniqie.'.'.$file->getClientOriginalExtension();
                $subPath = date("Y").'/'.date("M").'/'.date("d");
                if (!file_exists(storage_path('app/public/'.$folder.'/'.$subPath))) {
                    mkdir(storage_path('app/public/'.$folder.'/'.$subPath), 0777, true);
                }
                $file->move(storage_path('app/public/'.$folder.'/'.$subPath), $filename);
                $url = url('storage/'.$folder).'/'.$subPath.'/'.$filename;
                header('Content-type: application/json');
                \http_response_code(200);
                echo json_encode(['status'=>true,'data'=>$url]);
                exit();
            }
        }
        jsonValidationException(['file' => 'Произошла ошибка при загрузке файла']);
    }
    public function clean($string) {
        $string = str_replace(' ', '-', $string);
        return str_ireplace( array("'",'"','?',',' , ';', '<', '>','~','!','@','#','$','%','^','&','*','(',')','+','№','|','/',"\'",'`','{','}',':','=' ), '', $string); 
    }
    public function redirectOldClubsURLS($id){
        $club = club::where('id',$id)->select('id','club_city','url')->with(array('city' => function($query) {
            $query->select('id','en_name');
        }))->findOrFail($id);
        return redirect($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name);
    }
      
  public function likeClub(Request $request){
    $data = $request->validate([
        'club_id' => ['required']
    ]);
    if(club::where('id',$request->input('club_id'))->count() == 0){
        return response()->json(['status'=>false],400);
    }
    $liked_club = liked_club::firstOrCreate(['user_id'=>Auth::user()->id,'club_id'=>$request->input('club_id')]);
    if($liked_club){
        return response()->json(['status'=>true]);
    }else{
        return response()->json(['status'=>false],400);
    }
  }
  public function unLikeClub(Request $request){
    $data = $request->validate([
        'club_id' => ['required']
    ]);
    $liked_club = liked_club::where('club_id',$request->input('club_id'))->where('user_id',Auth::user()->id)->delete();

    return response()->json(['status'=>true]);
  }
}
