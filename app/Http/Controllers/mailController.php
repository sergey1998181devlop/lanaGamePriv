<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;
use Auth;
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
}
