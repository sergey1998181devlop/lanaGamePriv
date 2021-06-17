<?php

namespace  App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\contact;
use Carbon\Carbon;
use App\club;
use App\langame_request;
class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('rule:1');
    }

    public function index()
    {
        $newMessages = contact::whereNull('seen_at')->count();
        $newClubs= club::UnderEdit()->count();
        $newLangameRequests= langame_request::whereNull('seen_at')->count();
        return view('admin.home')->with(['newMessages'=>$newMessages,'newClubs'=>$newClubs,'newLangameRequests'=>$newLangameRequests]);
    }
    public function contacts(){
        $messages = contact::select('id','name','phone','email','created_at','seen_at')->orderBy('seen_at','asc')->orderBy('created_at','asc')->get();
        $newCount = contact::whereNull('seen_at')->count();
        return view('admin.contacts.contacts')->with(['messages'=>$messages,'newCount'=>$newCount]);
    }
    public function getMessage(Request $request)
    {
        $message = contact::findOrFail($request->input('id'));
        if($message->seen_at == null){
            $message->seen_at = Carbon::now()->toDateTimeString();
            $message->save();
        }
        $html = '<p>'.$message->name.'</p>';
        $html .= '<p>'.$message->email.'</p>';
        $html .= '<p>'.$message->phone.'</p>';
        $html .= '<h4>'.$message->message.'</h4>';
        $html .= '<p>'.$message->created_at.'</p>';
        return response()->json(['status'=>'success','html'=>$html], 202);
    }
    public function deleteMessage(Request $request)
    {
        $message = contact::findOrFail($request->input('id'));
        $message->delete();
        return back()->with('success',__('messages.Success'));
    }
    public function langameRequests(){
        $langame_requests = langame_request::orderBy('seen_at','asc')->orderBy('created_at','asc')->get();
        $newCount = langame_request::whereNull('seen_at')->count();
        return view('admin.contacts.langame_software')->with(['requests'=>$langame_requests,'newCount'=>$newCount]);
    }
    public function deleteRequest(Request $request)
    {
        $langame_requests = langame_request::findOrFail($request->input('id'));
        $langame_requests->delete();
        return back()->with('success',__('messages.Success'));
    }
    public function langameRequestsToggle($id)
    {
        $langame_requests = langame_request::select('id','seen_at')->findOrFail($id);
        if($langame_requests->seen_at === null ){
            $langame_requests->seen_at = Carbon::now()->toDateTimeString();
        }else{
            $langame_requests->seen_at = null;
        }
        if( $langame_requests->save())
        return back()->with('success',__('messages.Success'));
    }
}
