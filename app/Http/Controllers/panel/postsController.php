<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller; 
use App\Jobs\save_image;
use Image;
use App\post;
use App\User;
use Illuminate\Support\Facades\Storage; 


include_once(resource_path('views/includes/functions.blade.php'));
class postsController extends Controller
{
    public $email;
    public $name;
    public $postName;
    public function __construct()
{       
    $this->middleware('rule:1');  
}

public function store(Request $request){
    $validatedData =  $this->validate($request ,[
        'about'=>'required',
         'name'=>'required',
         'img'=>'required|image|mimes:jpeg,png,jpg',
    ]);
    // type 0 => posts в конце
    // type 1 => в средении главной страницы

    $errors=array();
    $user=Auth::user();
  
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
            }
            $image=(new save_image())->saveImage($request->file('img'),'posts') ;
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
        }
    $post=new post;
    $post->name=$request->input('name');
    $post->about= $request->input('about');
    $post->image=$image;
    $post->url=ucwords(str_replace(" ","-",$request->input('name')));
    $post->save();

return redirect('post/read/'.$post->id.'/'.$post->url);
}


public function update(Request $request,$id){
    $validatedData =  $this->validate($request ,[
        'about'=>'required',
         'name'=>'required',
    ]);
    $post=post::findOrFail($id);
    $errors=array();
  
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
            }
 
         if($request->hasFile('img'))
         {
            $validatedData =  $this->validate($request ,[
                'img.*'=>'image|mimes:jpeg,png,jpg,',
            ]);
            $newImage=(new save_image())->saveImage($request->file('img'),'posts') ;
            (new save_image())->remove_images($post->image,'posts') ;
            $post->image=$newImage;
         }
    if (count($errors) > 0){
        return back()->withInput()->withErrors($errors);
        }

    $post->name=$request->input('name');
    $post->about= $request->input('about');
    $post->url=ucwords(str_replace(" ","-",$request->input('name')));
    $post->save();

return redirect('post/read/'.$post->id.'/'.$post->url.'?edited');
}

function postToUpdste($id){
    $post=post::findOrFail($id);
     return view('admin.posts.edit')->with(['post'=>$post]);
}

public function saveImage(Request $request){
    
    $message = $url = '';
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        if ($file->isValid()) {
            $uniqie=time().uniqid();
            $filename = $uniqie.$file->getClientOriginalName() ;
            $file->move(storage_path('app/public/imagesInposts/'), $filename);
            $url = url('storage/app/public/imagesInposts/').'/'. $filename;
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
        $post=post::findorFail($id);
     if($post->delete()){
        $this->ClearRemovedpost($post);
        }
        return redirect('/');
    }
     public function ClearRemovedpost($post){
        if(!empty($post->image)){
                 Storage::delete('public/posts/'.$post->image);
                Storage::delete('public/posts/thumbnail/'.$post->image);
         }
     }
    

     
    
    
    

    
}

