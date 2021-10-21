<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller; 
use App\Jobs\save_image;
use Image;
use App\offer;
use App\User;
use Carbon\Carbon;
use Notification;
use Illuminate\Support\Facades\Storage; 
use Str;

include_once(resource_path('views/includes/functions.blade.php'));
class offersController extends Controller
{
    public $email;
    public $name;
    public $offerName;
    public function __construct()
{       
    $this->middleware('rule:1');  
}
public function index(){
    $offers= offer::select('id','url','name','views','views_click','order_no','created_at')->where('type','=','newBrand')->get();
    return view('admin.offers.offers')->with(['offers'=>$offers]);
}
public function indexClub(){
    $offers= offer::select('*')->where('type','=','newClub')->get();
    return view('admin.offers_clubs.offers')->with(['offers'=>$offers]);
}

public function active($id){
    $offer=offer::where('id',$id)->first();
    $offer->published_at =Carbon::now()->toDateTimeString();
    $offer->published_by =Auth::user()->id;
    $offer->unpublished_at =null;
    $offer->unpublished_by =null;
    $offer->last_admin_edit =Auth::user()->id;
    $offer->save();
    return redirect(url("panel/offers/allClub"));
}

public function deactive($id){
    $offer=offer::where('id',$id)->first();
    $offer->published_at =null;
    $offer->published_by =Auth::user()->id;
    $offer->unpublished_at =null;
    $offer->unpublished_by =null;
    $offer->last_admin_edit =Auth::user()->id;
    $offer->save();
    return redirect(url("panel/offers/allClub"));
}
public function store(Request $request){
    $validatedData =  $this->validate($request ,[
         'name'=>'required',
         'img'=>'required|image|mimes:jpeg,png,jpg',
    ]);

    $errors=array();
    $user=Auth::user();
  
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
            }
            $image=(new save_image())->saveImage($request->file('img'),'offers') ;
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
        }
    $offer=new offer;
    $offer->name=$request->input('name');
    $offer->about= $request->input('about');
    $offer->description= $request->input('description');
    $offer->user_name= $request->input('user_name');
    $offer->user_phone= $request->input('user_phone');
    $offer->price= $request->input('price');
    $offer->user_link= $request->input('user_link');
    $offer->user_email= $request->input('user_email');
    $offer->type= $request->input('type');
    $offer->image=$image;
    $offer->url=ucwords(str_replace(" ","-",$request->input('name')));
    $offer->save();

    return redirect(url("panel/offers/allClub"));
}
public function clean($string) {
    $string = str_replace(' ', '-', $string);
    return str_ireplace( array("'",'"','?',',' , ';', '<', '>','~','!','@','#','$','%','^','&','*','(',')','+','№','|','/',"\'",'`','{','}',':','=' ), '', $string); 
}

public function update(Request $request,$id){
    $validatedData =  $this->validate($request ,[
         'name'=>'required',
    ]);
    $offer=offer::findOrFail($id);
    $errors=array();
  
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
            }
 
         if($request->hasFile('img'))
         {
            $validatedData =  $this->validate($request ,[
                'img.*'=>'image|mimes:jpeg,png,jpg,',
            ]);
            $newImage=(new save_image())->saveImage($request->file('img'),'offers') ;
            (new save_image())->remove_images($offer->image,'offers') ;
            $offer->image=$newImage;
         }
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
        }

    $offer->name=$request->input('name');
    $offer->about= $request->input('about');
    $offer->description= $request->input('description');
    $offer->user_name= $request->input('user_name');
    $offer->user_phone= $request->input('user_phone');
    $offer->price= $request->input('price');
    $offer->user_link= $request->input('user_link');
    $offer->user_email= $request->input('user_email');
    $offer->type= $request->input('type');
    $offer->url=ucwords(str_replace(" ","-",$request->input('name')));
    $offer->save();
    
    return redirect(url("panel/offers/allClub"));
}

function offerToUpdste($id){
    $offer=offer::findOrFail($id);
    if ($offer->type=="newClub"){
        return view('admin.offers_clubs.edit')->with(['offer'=>$offer]);
    }else{
        return view('admin.offers.edit')->with(['offer'=>$offer]);
    }
}

public function saveImage(Request $request){
    
    $message = $url = '';
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        if ($file->isValid()) {
            $uniqie=time().uniqid();
            $filename = $uniqie.preg_replace('/\s+/', '_', $file->getClientOriginalName()) ;
            $file->move(storage_path('app/public/imagesInoffers/'), $filename);
            $url = url('storage/imagesInoffers/').'/'. $filename;
            return response()->json(['uploaded' => '1', "fileName"=> $filename ,
            "url"=>$url,'default'=> $url]);
        } else {
            $message = 'An error occured while uploading the file.';
        }
    } else {
        $message = 'No file uploaded.';
    }
    
    return response()->json(['uploaded' => '0', "error"=> [
        "message"=> "An error occured while uploading the file."]
    ]);
 
}

public function delete(Request $request,$id)
{
    $offer=offer::findorFail($id);
    if($offer->delete()){
        $this->ClearRemovedoffer($offer);
    }
    if($request->input('panel') == 1){
        return back()->with('success','Операция выполнена успешно');
    }
    return redirect('/');
}
    public function ClearRemovedoffer($offer){
    if(!empty($offer->image)){
                Storage::delete('public/offers/'.$offer->image);
            Storage::delete('public/offers/thumbnail/'.$offer->image);
        }
    }
public function newOffer(){
    return view('admin.offers.add');
}
public function newOfferClub(){
    return view('admin.offers_clubs.add');
}

public function reOrderOffer(Request $request){
    $validatedData =  $this->validate($request ,[
        'order_no'=>'required|numeric|min:0',
    ]);
    $offer=offer::findorFail($request->input('id'));
    $offer->order_no = $request->input('order_no');
    $offer->save();
    return back()->with('success','Операция выполнена успешно');
}

}

