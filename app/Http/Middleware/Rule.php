<?php

namespace App\Http\Middleware;

use Closure;
use Auth;   

class rule
{

/**
 * 0 ->normal user
 * 1->contllor items 
 * 2->contllor users 
 */



    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$section)
    {        
        if(Auth::guest()){ return redirect('/');}
      $rule=Auth::User()->rules;
      
  if($rule>=$section){return $next($request);}
  
   return redirect('/');
    }
}