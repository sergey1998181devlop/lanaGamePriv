<?php

namespace App\Http\Controllers\Auth;

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
include_once(resource_path('views/includes/functions.blade.php')); 
class RegisterController extends Controller
{
    protected $redirectTo = 'personal/clubs?action=add_club';
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('guest', ['only' => ['create','sendSMS','verifySMS','sendSMSViaService']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'phone' => ['required', 'numeric','digits:10', 'unique:users'],
    //         'user_position'=>['required'],
    //         'conf_code'=>['required'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'phone' => ['required', 'numeric','digits:10', 'unique:users'],
            'user_position'=>['required','numeric','min:1','max:4'],
            'conf_code'=>['required'],
        ]);

        if(!$this->verify($request->input('phone'),$request->input('conf_code'))){
            return response()->json(['status'=>'success','error'=>'Неверный код'], 202);
        }
        $user =  User::create([
            'name' => $request->input('name'),
            'email' =>$request->input('email'),
            'phone' => $request->input('phone'),
            'user_position' =>$request->input('user_position'),
            'password' => Hash::make($request->input('password')),
        ]);
        Auth::login($user);

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
}
