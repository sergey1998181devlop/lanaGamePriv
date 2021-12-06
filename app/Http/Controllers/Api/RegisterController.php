<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon;
use App\sms_code;
use App\Jobs\SMSRU;
use Auth;
use App\UserVerify;
use App\city;
use Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['getUserData']]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'phone' => ['required', 'numeric','digits:10', 'unique:users'],
            'conf_code'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'msg'=>'Validation Error','errors'=>$validator->errors()], 202);
        }
        $type = $request->input('user_type') == 'player' ?'player' : 'owner';
        $city = null;
        if($type == 'player'){
            $validator = Validator::make($request->all(), [
                'city'=>['required'],
            ]);
            if($validator->fails()){
                return response()->json(['status'=>false,'msg'=>'Validation Error','errors'=>$validator->errors()], 202);
            }
            $city =  $request->input('city');
            if(!city::first($city)){
                jsonValidationException(['city' => 'Город не определен']);
            }
        }else{
            $validator = Validator::make($request->all(), [
                'user_position'=>['required','numeric','min:1','max:4'],
            ]);
            if($validator->fails()){
                return response()->json(['status'=>false,'msg'=>'Validation Error','errors'=>$validator->errors()], 202);
            }
        }
        if(!$this->verify($request->input('phone'),$request->input('conf_code'))){
            return response()->json(['status'=>false,'error'=>'Неверный код'], 202);
        }
        $user =  User::create([
            'name' => $request->input('name'),
            'email' =>$request->input('email'),
            'phone' => $request->input('phone'),
            'user_position' =>$request->input('user_position'),
            'password' => Hash::make($request->input('password')),
            'type' => $type,
            'city' =>$city
        ]);
        Auth::login($user);
        $token = Str::random(64);
        UserVerify::create([
            'user_id' => $user->id, 
            'token' => $token
          ]);
          Mail::send('emails.user.emailVerificationEmail', ['token' => $token], function($message) use($user){
            $message->to($user->email);
            $message->subject('Завершение регистрации на Langame');
        });
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        $success['phone'] =  $user->phone;
        $success['email'] =  $user->email;
        $success['user_type'] =  $user->user_type;
        $user->createToken('MyApp')-> accessToken;
        return response()->json(['status'=>true,'data'=>$success], 202);
    }

    public function sendSMS(Request $request){
        
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'numeric','digits:10', 'unique:users'],
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false,'msg'=>'Validation Error','errors'=>$validator->errors()], 202);
        }

        $sms_code = sms_code::where('phone',$request->input('phone'))->first();
        if($sms_code){
            if($sms_code->created_at->diffInSeconds(Carbon::now()) > 180){
                $sms_code->delete();
               $send =  $this->send($request);
            }else{
                return response()->json(['status'=>false,'msg'=>'codeSentWithin3Minutes'], 202);
            }

        }else{
            $send =   $this->send($request);
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
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'numeric','digits:10'],
            'confirm_code' => ['required', 'numeric','digits:4'],
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'msg'=>'Validation Error','errors'=>$validator->errors()], 202);
        }
        if($this->verify($request->input('phone'),$request->input('confirm_code'))){
            return response()->json(['status'=>true], 202);
        }else{
            return response()->json(['status'=>false,'error'=>'Неверный код'], 202);
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

    public function login(Request $request)
    {
        if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $success['phone'] =  $user->phone;
            $success['email'] =  $user->email;
            $success['user_type'] =  $user->user_type;
            return response()->json(['status'=>true,'data'=>$success], 202);
        }
        else{
            return response()->json(['status'=>false,'msg'=>'Unauthorised'], 202);
        } 
    }
    public function getUserData(){
        return response()->json(['status'=>true,'user'=>Auth::user()], 202);
    }
}
