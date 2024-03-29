<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\sms_code;
use App\Jobs\CallPassword;
use Carbon;
use Illuminate\Support\Facades\Hash;
use App\UserVerify;
use Mail;
use Illuminate\Support\Str;
use App\city;
use App\club;
include_once(resource_path('views/includes/functions.blade.php')); 

class personalController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('player',['only' => ['likedClubs']]);
    }


    public function profile(){
        $user = Auth::user();
        return view('personal/profile')->with('user',$user);
    }
    public function likedClubs(){
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
    
        $user_id= Auth::user()->id;
        $clubs = club::SelectCartFeilds4Home($lat, $lon)->whereHas('liked', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->Published()->whereNull('hidden_at')->with(array('metro'=>function($query) {
            $query->select('id','name','color');
        },
        'city' => function($query) {
            $query->select('id','en_name');
        }))->get();
        return view('personal/liked')->with('clubs',$clubs);
    }
    public function sendSMS(Request $request){
        
        $data = $request->validate([
            'phone' => ['required', 'numeric','digits:10', 'unique:users'],
        ]);
        $sms_code = sms_code::where('phone',$request->input('phone'))->first();
        if($sms_code){
            if($sms_code->created_at->diffInSeconds(Carbon::now()) > 180){
                $sms_code->delete();
               $send =  $this->send($request);
            }else{
                return response()->json(['status'=>'success','msg'=>'codeSentWithin3Minutes'], 202);
            }

        }else{
            $send =   $this->send($request);
        }
        if($send ){
            return response()->json(['status'=>'success'], 202);
        }
        return response()->json(['status'=>'false','msg'=>'Ошибка отправки кода'], 202);
    }
    public function send($request){
        $sms_code=new sms_code();
        $sms_code->phone = $request->input('phone');
        $sms_code->code= rand ( 1000 , 9999 );
        if($sms_code->save()){
            if($this->sendSMSViaService($request->input('phone'),$sms_code->code)){
                return true;
            }else{
                $sms_code->delete();
            }
        }
        return false;
    }

    public function verifySMS(Request $request){
        $data = $request->validate([
            'phone' => ['required', 'numeric','digits:10'],
            'confirm_code' => ['required', 'numeric','digits:4'],
        ]);
        if($this->verify($request->input('phone'),$request->input('confirm_code'))){
          $user = Auth::user();
          $user ->phone = $request->input('phone');
          $user ->save();
            return response()->json(['status'=>'success'], 202);
        }else{
            return response()->json(['status'=>'success','error'=>'Неверный код'], 202);
        }
    }
    public function verify($phone,$code){
        $sms_code = sms_code::where('code',$code)->where('phone',$phone)->where('created_at', '>=', Carbon::now()->subMinutes(30)->toDateTimeString())->first();
        if($sms_code){
            return true;
        }else{
            return false;
        }
    }

    public static function sendSMSViaService($phone, $confirm_code)
  {
    $smsru = new CallPassword();
    return $smsru->call($phone, $confirm_code); // Отправка сообщения и возврат данных в переменную
  }
  public function update(Request $request){
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
    ]);
    if(owner()){
        $data = $request->validate([
            'user_position'=>['required','numeric','min:1','max:4'],
        ]);
    }elseif(player()){
        $data = $request->validate([
            'city' => ['required']
        ]);
        city::findOrFail($request->input('city'));
    }
    $user = Auth::user();
    if($request->input('email') != $user->email){
        if(owner()){
            $data = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
        }elseif($request->input('email') !=''){
            $data = $request->validate([
                'email' => ['string', 'email', 'max:255', 'unique:users']
            ]);
        }
        $user->email = $request->input('email');
    }
   if(!empty($request->input('password')) && $request->input('password') != ''){
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user->password = Hash::make($request->input('password'));
   }
   $user->name = $request->input('name');
   if(owner()){
   $user->user_position = $request->input('user_position');
   }elseif(player()){
   $user->city = $request->input('city');
   }
   if($user->save()){
    return response()->json(['status'=>'success'], 202);
   }
   return response()->json(['status'=>'false'], 202);
  }
  public function resendVerfyEmail(){
    $user = Auth::user();
    if($user->email_verified_at == null) {
        $token = Str::random(64);
        $UserVerify = UserVerify::firstOrCreate([
            'user_id' => $user->id
          ]);
          $UserVerify->token = $token;
          $UserVerify->save();
          Mail::send('emails.user.emailVerificationEmail', ['token' => $token], function($message) use($user){
            $message->to($user->email);
            $message->subject('Завершение регистрации на Langame');
        });
        return back();
    }
    abort(402);
  }
}
