<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Hash;
class usersController extends Controller
{
    public function __construct()
    {
        $this->middleware('rule:2');
    }
    public function index(){
        $users=User::all();
        return view('admin.users.users')->with(['users'=>$users]);
    }
    // public function register(Request $request) 
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required', 
    //         'email' => 'required|email|unique:users', 
    //         'password' => 'required', 
    //         'password_confirmation' => 'required|same:password',
    //     ]);
    //     if ($validator->fails()) {
    //                 return back()->with('errors',$validator->errors())->withInput();
    //             }
    //      $input = $request->all(); 
    //             $input['password'] = Hash::make($input['password']); 
    //             $input['rule'] =2;
    //             $user = User::create($input);
    //             $success['name'] =  $user->name;
    //     return back()->with('success','Создано успешно'); 
    //         }
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
}
