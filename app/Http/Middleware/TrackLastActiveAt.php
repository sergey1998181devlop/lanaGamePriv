<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Auth;
class TrackLastActiveAt
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guest()) {
            return $next($request);
        }

        $user = Auth::user();
        $user->last_active_at = now();
        $user->timestamps  = false;
        $user->save();

        return $next($request);
    }
}
?>