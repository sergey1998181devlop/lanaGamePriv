<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

use App\offer;
use App\club;
use Auth;
include_once(resource_path('views/includes/functions.blade.php')); 
class offersController extends Controller
{
    public function __construct()
    {
        $this->middleware('owner');
    }
    public function views($id){
        $offer=offer::select('id','views')->where('id',$id)->first();
        if(!$offer ){
            abort(404);
        }
        $views=$offer->views;
        $views++;
        $offer->views=$views;
        $offer->save();
    }
    public function views_click($id){
        $offer=offer::select('id','views_click')->where('id',$id)->first();
        if(!$offer ){
            abort(404);
        }
        $views_click=$offer->views_click;
        $views_click++;
        $offer->views_click=$views_click;
        $offer->save();
    }
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
     public function addFromUser(Request $request){
         $validatedData =  $this->validate($request ,[
              'name'=>'required',
              'offer_photos'=>'required',
         ]);
     
         $errors=array();

         if (count($errors) > 0){
             return back()->withInput()->withErrors($errors);
            }

        $filename = explode('/storage/',$request->input('offer_photos'));

         $offer=new offer;
         $offer->name=$request->input('name');
         $offer->about= $request->input('about');
         $offer->description= strip_tags($request->input('description'));
         $offer->user_id = Auth::user()->id;
         $offer->price= $request->input('price');
         $offer->type= "newClub";
         $offer->image="../".$filename[1];
         $offer->url=ucwords(str_replace(" ","-",$request->input('name')));
         $offer->save();
         return true;
     }
     
}
