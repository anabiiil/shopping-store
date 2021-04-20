<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontAuth
{

    public function handle($request, Closure $next=null , $guard='web')
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }else{
            return redirect('front/login');
        }

    }
}
