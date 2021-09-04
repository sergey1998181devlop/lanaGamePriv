<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;
use App\report;
use Auth;
use App\langame_request;
use App\subscribe;
class mailController extends Controller
{
    public function storeFromContacts(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required'],
        ]);
        $contact = new contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        if($request->input('phone') != '')
        $contact->phone = $request->input('phone');
        if(!Auth::guest())
        $contact->user_id =Auth::user()->id;
        if($contact->save())
        return back()->with(['success'=>'Сообщение успешно отправлено']);;
    }
    public function langameRequest(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'city' => ['required'],
            'club_name' => ['required']
        ]);
        $langame_request = new langame_request();
        $langame_request->name = $request->input('name');
        $langame_request->email = $request->input('email');
        $langame_request->city = $request->input('city');
        $langame_request->club_name = $request->input('club_name');
        if($request->input('phone') != '')
        $langame_request->phone = $request->input('phone');
        if(!Auth::guest())
        $langame_request->user_id =Auth::user()->id;
        if($langame_request->save())
        return back()->with(['success'=>'Сообщение успешно отправлено']);
    }
    public function reportError(Request $request){
        $data = $request->validate([
            'message' => ['required'],
        ]);
        $report = new report();
        $report->message = $request->input('message');
        $report->url =$request->input('url');
        if(!Auth::guest())
        $report->user_id =Auth::user()->id;
        if($report->save())
        return back()->with(['success'=>'Сообщение успешно отправлено']);
    }
    public function subscribe(Request $request){
        $data = $request->validate([
            'type' => ['required', 'string','in:gamer,owner'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $subscribe=subscribe::firstOrNew(['email'=>$request->input('email')]);
        $subscribe->type=$request->input('type');
        $subscribe->save();
        return back()->with(['success'=>'успешно отправлено']);
    }
}
