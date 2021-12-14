<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User;
use Auth;
use App\city;
use App\sms_code;
use App\Jobs\SMSRU;
use Carbon;
use Illuminate\Support\Facades\Hash;
class personalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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
            if(!city::where('id',$request->input('city'))->first('id')){
                jsonValidationException(['city' => ['Город не определен']]);
            }
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
        return response()->json(['status'=>true], 202);
       }
       return response()->json(['status'=>false], 202);
    }
    public function sendSMS(Request $request){
        
        $data = $request->validate([
            'phone' => ['required', 'numeric','digits:10', 'unique:users'],
        ]);
        $sms_code = sms_code::where('phone',$request->input('phone'))->first();
        if($sms_code){
            $diffInSeconds = $sms_code->created_at->diffInSeconds(Carbon::now());
            if($diffInSeconds > 180){
                $sms_code->delete();
               $send =  $this->send($request);
            }else{
                return response()->json(['status'=>false,'msg'=>'codeSentWithin3Minutes','leftSeconds'=>(180 - $diffInSeconds)], 202);
            }

        }else{
            $send = $this->send($request);
        }
        if($send ){
            return response()->json(['status'=>true], 202);
        }
        return response()->json(['status'=>false,'msg'=>'Ошибка отправки SMS'], 202);
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
            return response()->json(['status'=>true], 202);
        }else{
            return response()->json(['status'=>false,'msg'=>'Неверный код'], 202);
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
}
