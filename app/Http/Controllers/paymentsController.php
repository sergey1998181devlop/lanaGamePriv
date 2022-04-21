<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller; 
use App\User;
use App\email;
use Carbon\Carbon;
use Notification;
use Illuminate\Support\Facades\Storage; 
use Str;

include_once(resource_path('views/includes/functions.blade.php'));
class paymentsController extends Controller
{
    public $name;
    public $payed;
    public function __construct()
    {       
    }
    public function front(Request $request){
        if (!empty($request->input('email'))){
            $emails= email::select('user_email')->where('user_email', $request->input('email'))->limit(1)->get();
        }else{
            $emails = "";
        }
        return view('email')->with(['emails'=>$emails]);
    }
    public function check(Request $request){
        if ($request->input("OperationType")=="Payment"){
            $email = email::select('*')->where('user_email', $request->input('Email'))->first();            
            $email->price = $email->price + intval($request->input('PaymentAmount'));
            $email->payed_at = Carbon::now()->toDateTimeString();
            $email->save();
        }
        //file_put_contents("/home/bitrix/dev.langame.ru/langame.ru/log_payment.txt", print_r($_GET, true), FILE_APPEND);
    }

}

