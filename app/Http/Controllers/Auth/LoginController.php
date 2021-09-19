<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
include_once(resource_path('views/includes/functions.blade.php')); 
class LoginController extends Controller
{
    protected $redirectTo = '/';
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function username()
    {
        return 'phone';
    }
    // protected function guard()
    // {
    //     return Auth::guard('phone');
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // do login Auth
    public function loginUser(Request $request)
    {
    	$phone	       = $request->phone;
    	$password      = $request->password;
    	$rememberToken = $request->remember;
		if (Auth::guard('web')->attempt(['phone' => $phone, 'password' => $password], $rememberToken)) {
			$msg = array(
				'status'  => 'success',
				'message' => 'Login Successful'
			);
			return response()->json($msg);
		}
		 else {
			$msg = array(
				'status'  => 'error',
				'message' => 'Login Fail !'
			);
			return response()->json($msg);
		}
    }
}
