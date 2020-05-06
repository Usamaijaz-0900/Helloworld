<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, $guard = null)
    {
        dd('ok');
           dd(Auth::check());
        if (Auth::check()) {
            if($request->ajax()){
                return response('Unauthorized', 401);
            }
            else{
                return redirect()->route('hash');
            }   
        }
    }
          
}
