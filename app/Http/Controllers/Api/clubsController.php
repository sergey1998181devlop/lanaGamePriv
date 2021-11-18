<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Str;
use App\club;
include_once(resource_path('views/includes/functions.blade.php')); 
class clubsController extends Controller
{
    public function index($id,Request $request){
        $lon = ($request->input('lon')) ? $request->input('lon') : 0;
        $lat =($request->input('lat')) ? $request->input('lat') : 0 ;
        $club = club::where('id',$id)->select('*', club::raw('round(1.6 * ( 3959 * acos( cos( radians("'.$lat.'") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians("'.$lon.'") ) + sin( radians("'.$lat.'") ) * sin( radians( lat ) ) ) ),1) AS nearby'))->where('draft','0')->with(array('city' => function($query) {
            $query->select('id','name', 'en_name');
        },'metro'=>function($query) {
            $query->select('id','name','color');
        }))->first();
        if(!$club){
            return response()->json(['status'=>false,'msg'=>'non_found'], 202);
        }
        return response()->json(['status'=>true,'msg'=>$club], 202);
    }
     
}
