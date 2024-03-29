<?php

namespace App\Http\Controllers\Panel;

use App\club;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Mail;
class usersController extends Controller
{
    public function __construct()
    {
        $this->middleware('rule:2', ['except' => ['find', 'index', 'sendMail']]);
        $this->middleware('rule:1');
    }
    public function index(){
        $users = User::
        with(
            'clubs'
        )
            ->where('type','owner')
            ->orderBy('created_at','DESC')->get();

        $messClubs = [];
        foreach ($users as $user){
            if(count($user->clubs) > 0){
               foreach ($user->clubs as $club){
                    if(!empty($club->published_at)){
                        $user->clubPublished++;
                        $messClubs['messClubs']['clubPublished'][] = $club;
                    }
                    if($club->draft == 1){
                        $user->clubDraft++;
                        $messClubs['messClubs']['draft'][] = $club;
                    }
                   if($club->closed == 1){
                       $user->clubClosed++;
                       $messClubs['messClubs']['clubClosed'][] = $club;
                   }
               }
            }
            $user->userClubsCount = $user->clubPublished > 0 ? 'опуб.('.$user->clubPublished.')'   : 'опуб.(0)' ;
            $user->userClubsCount .= $user->clubDraft > 0 ? 'черн.(' .$user->clubDraft. ')' : 'черн.(0)' ;
            $user->userClubsCount .= $user->clubClosed > 0 ? 'на мод.(' .$user->clubClosed. ')' : 'на мод.(0)' ;
            if(!empty($messClubs['messClubs'])){
                $user->userMessClubs = $messClubs['messClubs'];
                unset($messClubs);
            }
        }



        return view('admin.users.users')->with(['users'=>$users]);
    }
    public function players(){
        $users=User::where('type','player')->orderBy('created_at','DESC')->get();
        return view('admin.users.players')->with(['users'=>$users]);
    }
    public function edit(Request $request){
        $validatedData =  $this->validate($request ,[
            'name'=>'required|string|max:55|min:4',
            'id'=>'required|numeric',
            'rules'=>'required|numeric|min:0|max:2',
        ]);
        $input=$request;
        $user=User::findorFail($input->input('id'));
        if(!empty($input->password ) ){
            $validatedData =  $this->validate($request ,[
                'password'=> 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ]);
            $user->password =Hash::make($request->input('password'));

            }
        if($input->email != $user->email ){
            $validatedData =  $this->validate($request ,[
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }
        if($input->phone != $user->phone ){
            $validatedData =  $this->validate($request ,[
                'phone' => ['required', 'numeric','digits:10', 'unique:users'],
            ]);
        }
        $user->name=$input->name;
        $user->email=$input->email;
        $user->phone=$input->phone;
        $user->rules=$input->rules;
        $user->save();
        return back()->with('success',__('messages.SupdatetSuccess'));
    }
    // public function toggleadmin($id){
    //     if($id!=1){
    //     $user=User::findorFail($id);
    //     $user->rule=($user->rule == 0) ? 1 : 0;
    //     $user->save();}
    //     return back()->with('success',__('messages.SupdatetSuccess'));

    // }

    public function delete(Request $request){
        if($request->input('userId')!=1){
            $user=User::findorFail($request->input('userId'));
            $user->delete();
            return back()->with('success',__('messages.Success'));
        }
        else{
            abort('404');
        }
    }

    public function find(Request $request){
            $b = array();
            $b['query']='Unit';
            if(($request->input('query'))){
              $Users=User::select('id','name','phone')->where('email', 'like', '%' . $request->input('query') . '%')->orWhere('phone', 'like', '%' . $request->input('query') . '%')->get();
            }
            foreach ($Users as $User) {
              $b["suggestions"][]=[ "value"=> $User->name.'-'.$User->phone,'data'=>$User->id];
             }
             return response($b);
    }
    public function sendMail(Request $request){
        $validatedData =  $this->validate($request ,[
            'subject'=>'required',
            'id'=>'required|numeric',
            'message'=>'required',
        ]);
        $user = User::findorFail($request->input('id'));
        Mail::send('emails.user.userMail', ['content' =>  $request->input('message'),'subject'=>$request->input('subject')], function($message) use($user,$request){
            $message->to($user->email);
            $message->subject($request->input('subject'));
        });
        return response()->json(['status'=>'success']);
    }

}

