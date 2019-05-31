<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$role)
    {
        $isAdmin = false;
        foreach(Auth::user()->roller as $rol){
            if($rol->name == 'Admin'){
                $isAdmin = true;
            }
            if(in_array($rol->name,$role)){
                return $next($request);
            }

        }
        if($isAdmin){
            return redirect('/admin/anasayfa');
        }

        return redirect('/');
      
    }
}
