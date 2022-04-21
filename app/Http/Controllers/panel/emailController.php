<?php

namespace App\Http\Controllers\Panel;

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
class emailController extends Controller
{
    public $name;
    public $payed;
    public function __construct()
    {       
        $this->middleware('rule:1');  
    }
    public function front(Request $request){
        if (!empty($request->input('email'))){
            $emails= email::select('user_email')->where('user_email', $request->input('email'))->limit(1)->get();
        }else{
            $emails = "";
        }
        return view('email')->with(['emails'=>$emails]);
    }
    public function index(){
        $emails= email::select('*')->get();
        return view('admin.emails.emails')->with(['emails'=>$emails]);
    }

    public function store(Request $request){
        $validatedData =  $this->validate($request ,[
             'name'=>'required',
             'user_email'=>'required',
        ]);
        $errors=array();
        $user=Auth::user();
        if (count($errors) > 0){
            return back()->withInput()->withErrors($errors);
        }
        $email=new email;
        $email->name_club=$request->input('name_club');
        $email->name=$request->input('name');
        $email->city=$request->input('city');
        $email->boss=$request->input('boss');
        $email->user_email=$request->input('user_email');
        $email->phone=$request->input('phone');
        $email->telegram=$request->input('telegram');
        
        $email->published_at =Carbon::now()->toDateTimeString();
    
        $email->save();
    
        return redirect(url("panel/emails/all"));
    }
    public function update(Request $request,$id){
        $email=email::findOrFail($id);
        $errors=array();
      
        $email->name_club=$request->input('name_club');
        $email->name=$request->input('name');
        $email->city=$request->input('city');
        $email->boss=$request->input('boss');
        $email->user_email=$request->input('user_email');
        $email->phone=$request->input('phone');
        $email->telegram=$request->input('telegram');
        
        $email->published_at =Carbon::now()->toDateTimeString();
    
        $email->save();
        
        return redirect(url("panel/emails/all"));
    }
    
    public function add(){
        return view('admin.emails.add');
    }
    function edit($id){
        $email=email::findOrFail($id);
        return view('admin.emails.edit')->with(['email'=>$email]);
    }
    public function active($id){
        $email=email::where('id',$id)->first();
        $email->published_at =Carbon::now()->toDateTimeString();
        $email->published_by =Auth::user()->id;
        $email->unpublished_at =null;
        $email->unpublished_by =null;
        $email->last_admin_edit =Auth::user()->id;
        $email->save();
        return redirect(url("panel/emails/all"));
    }

    public function deactive($id){
        $email=email::where('id',$id)->first();
        $email->published_at =null;
        $email->published_by =Auth::user()->id;
        $email->unpublished_at =null;
        $email->unpublished_by =null;
        $email->last_admin_edit =Auth::user()->id;
        $email->save();
        return redirect(url("panel/emails/all"));
    }

}

