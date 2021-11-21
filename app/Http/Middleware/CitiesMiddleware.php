<?php

namespace App\Http\Middleware;

use App\city;  //city model
use Closure;
use Request;
use Route;
class CitiesMiddleware
{
   /**
    * Handle an incoming request.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Closure                 $next
    *
    * @return mixed
    */
   public function handle($request, Closure $next)
   {
      if($request->route('city') != 'rossiya'){
         $city = city::where('en_name',$request->route('city'))->first();
         if($city  === null){ 
            return abort(404);
         }
      }else{
         $city = ['id'=>1,'name' =>'Вся Россия','en_name'=>'rossiya','namePrepositional'=>'России','parentName'=>'','metroMap'=>false,'lat'=>'61.671012','lon'=>'98.656920'];
      }
      $request->session()->put('city', $city);
      $request->session()->save();
    return $next($request);
   }
}