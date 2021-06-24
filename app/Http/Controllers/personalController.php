<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\sms_code;
use App\Jobs\SMSRU;
use Carbon;
use Illuminate\Support\Facades\Hash;
include_once(resource_path('views/includes/functions.blade.php')); 

class personalController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }


    public function profile(){
        $user = Auth::user();
        return view('personal/profile')->with('user',$user);
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
        return response()->json(['status'=>'false','msg'=>'Ошибка отправки SMS'], 202);
    }
    public function send($request){
        $sms_code=new sms_code();
        $sms_code->phone = $request->input('phone');
        $sms_code->code= rand ( 1000 , 9999 );
        if($sms_code->save()){
            if($this->sendSMSViaService($request->input('phone'),$sms_code->code)){
                return true;
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
        $sms_code = sms_code::where('code',$code)->where('phone',$phone)->first();
        if($sms_code){
            return true;
        }else{
            return false;
        }
    }

    public static function sendSMSViaService($phone, $confirm_code)
  {
    $smsru = new SMSRU(env('SMSRU_API_KEY'));
    $data = new \stdClass();
    $data->to = '7' . $phone;
    $data->text ='Ваш код подтверждения: '. $confirm_code .'. Наберите его в поле ввода.';
    $data->test = env('SMSRU_TEST',1);
    $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную
    if ($sms->status === 'OK') { // Запрос выполнен успешно
       return true;
    } else {
      return false;
    }
  }
  public function update(Request $request){
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'user_position'=>['required','numeric','min:1','max:4'],
    ]);
    $user = Auth::user();
    if($request->input('email') != $user->email){
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
        $user->email = $request->input('email');
    }
   if(!empty($request->input('password')) && $request->input('password') != ''){
        $data = $request->validate([
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
        $user->password = Hash::make($request->input('password'));
   }
   $user->name = $request->input('name');
   $user->user_position = $request->input('user_position');
   if($user->save()){
    return response()->json(['status'=>'success'], 202);
   }
   return response()->json(['status'=>'false'], 202);
  }
}
