<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;
use App\report;
use App\club_report;
use Auth;
use App\langame_request;
use App\subscribe;
use Illuminate\Validation\ValidationException;
class mailController extends Controller
{
    public function storeFromContacts(Request $request){

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required'],
        ]);
        $this->reCaptcha($request);
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
            'phone' => ['required'],
            'club_name' => ['required']
        ]);
        $this->reCaptcha($request);
        $langame_request = new langame_request();
        $langame_request->name = $request->input('name');
        $langame_request->email = $request->input('email');
        $langame_request->city = $request->input('city');
        $langame_request->club_name = $request->input('club_name');
        $langame_request->club_count = $request->input('club_count');
        $langame_request->club_pk_count = $request->input('club_pk_count');
        $langame_request->boss = $request->input('boss');
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
        $this->reCaptcha($request);
        $report = new report();
        $report->message = $request->input('message');
        $report->url =$request->input('url');
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $comments = '';
        $report->REMOTE_ADDR =$ip;
        if($request->important){
            $report->is_spam = 1;
            $comments = 'important,';
        }
        $report->pageOpend_at=$request->input('time');
        $report->comments=$comments;
        if(!Auth::guest())
        $report->user_id =Auth::user()->id;
        if($report->save())
        return back()->with(['success'=>'Сообщение успешно отправлено']);
    }
    // это для подержки старого адреса - чисто для анализа спама
    public function reportErrorSpam(Request $request){
        $data = $request->validate([
            'message' => ['required'],
        ]);
        $this->reCaptcha($request);
        $report = new report();
        $report->message = $request->input('message');
        $report->url =$request->input('url');
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $report->REMOTE_ADDR =$ip;
        $comments = '';
        $report->pageOpend_at=$request->input('time');
        if($request->important){
            $comments = 'important,';
        }
        $report->is_spam = 1;
        $comments .= 'reportErrorSpamOldURL';
        $report->comments=$comments;
        if(!Auth::guest())
        $report->user_id =Auth::user()->id;
        if($report->save())
        return back()->with(['success'=>'Сообщение успешно отправлено']);
    }
    public function reportClubError(Request $request){
        $data = $request->validate([
            'message' => ['required'],
        ]);
        $this->reCaptcha($request);
        $report = new club_report();
        $report->name = $request->input('name');
        $report->email = $request->input('email');
        $report->message = $request->input('message');
        if($request->input('phone') != '')
        $report->phone = $request->input('phone');
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
    public function reCaptcha($request){
        if($request->input('g-recaptcha-response')=='')
            throw ValidationException::withMessages(['g-recaptcha-response' => 'Необходимо пройти капчу']);
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode(env('RECAPCHA_SEC')) .  '&response=' . urlencode($request->input('g-recaptcha-response'));
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if(!$responseKeys["success"]){
            throw ValidationException::withMessages(['g-recaptcha-response' => 'Необходимо пройти капчу']);
            die();
        }
    }
}
