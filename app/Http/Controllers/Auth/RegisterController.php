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
use App\city;
use App\Jobs\CallPassword;
use Auth;
use App\UserVerify;
use Mail;
use Illuminate\Support\Str;
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
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'phone' => ['required', 'numeric','digits:10', 'unique:users'],
            'conf_code'=>['required'],
        ]);

        if(!$this->verify($request->input('phone'),$request->input('conf_code'))){
            return response()->json(['status'=>'success','error'=>'Неверный код'], 202);
        }
        $type = $request->input('user_type') == 'player' ?'player' : 'owner';
        $city = null;
        if($type == 'player'){
            $data = $request->validate([
                'city'=>['required'],
            ]);
            $city =  $request->input('city');
            city::findOrFail($city);
            if($request->input('email') != ''){
                $request->validate([
                    'email' => ['string', 'email', 'max:255', 'unique:users']
                ]);
            }
        }else{
            $data = $request->validate([
                'user_position'=>['required','numeric','min:1','max:4'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
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
          
        if($request->input('email') != ''){
            Mail::send('emails.user.emailVerificationEmail', ['token' => $token], function($message) use($user){
                $message->to($user->email);
                $message->subject('Завершение регистрации на Langame');
            });
        }

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
  public function verifyEmail($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'К сожалению, ваш адрес электронной почты не найден';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if($user->email_verified_at == null) {
                $verifyUser->user->email_verified_at = Carbon::now()->toDateTimeString();
                $verifyUser->user->save();
                $verifyUser->delete();
                $message = "Ваш e-mail подтвержден";
            } else {
                $message = "Ваш e-mail уже подтвержден";
            }
        }
  
      return redirect()->route('login')->with('verifyEmailMessage', $message);
    }
    public function registration(){
        return view('auth.register')->with(['showOptions'=>true]);
    }
}
