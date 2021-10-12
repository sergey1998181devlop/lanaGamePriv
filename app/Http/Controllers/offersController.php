<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

use App\offer;
use Auth;
include_once(resource_path('views/includes/functions.blade.php')); 
class offersController extends Controller
{
    public function offer($id,$url){
        $offer=offer::where('id',$id)->first();
        if(!$offer ){
            abort(404);
        }
        $views=$offer->views;
        $views++;
        $offer->views=$views;
        $offer->save();
        $moreOffers = offer::select('id','url','image','name')->where('id','!=',$offer->id)->inRandomOrder()->limit(2)->get();
        return view('offers.offer')->with(['offer'=>$offer,'moreOffers'=>$moreOffers]);
     }
     public function alloffers(){

        $offers=offer::orderBy('order_no','desc')->orderBy('created_at','desc')->paginate(100);

        return view('offers.offers')->with(['offers'=>$offers]);
     }
     public function addFromUser(Request $request){
         $validatedData =  $this->validate($request ,[
              'name'=>'required',
              'offer_photos'=>'required',
         ]);
     
         $errors=array();
         $user=Auth::user();
       
         if (count($errors) > 0){
             return back()->withInput()->withErrors($errors);
            }
         if (count($errors) > 0){
             return back()->withInput()->withErrors($errors);
             }

        $filename = explode('/storage/',$request->input('offer_photos'));

         $offer=new offer;
         $offer->name=$user->name;
         $offer->about= $request->input('about');
         $offer->description= $request->input('description');
         $offer->user_name= $request->input('user_name');
         $offer->user_phone= $user->phone;
         $offer->price= $request->input('price');
         $offer->user_link= $user->name;
         $offer->user_email= $user->email;
         $offer->type= "newClub";
         $offer->image="../".$filename[1];
         $offer->url=ucwords(str_replace(" ","-",$request->input('name')));
         $offer->save();
     
         return true;
     }
     
}
