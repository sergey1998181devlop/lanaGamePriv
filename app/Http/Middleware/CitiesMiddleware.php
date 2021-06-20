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
    $city = city::where('en_name',$request->route('city'))->first();
    if($city  === null){ 
      return abort(404);
   }
    $request->session()->put('city', $city);
    $request->session()->save();
    return $next($request);
   }
}