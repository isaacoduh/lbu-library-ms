<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChangeMiddleware
{
    public function handle(Request $request, Closure $next) {
      if (Auth::check() && Auth::user()->password_changed === true)  {
        return $next($request);
      } else{
        // Auth::logout();
        return redirect()->route('password.change');
      }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     // if(Auth::check() && Auth::user()->password_changed !== true){
    //     //     return redirect()->route('password.change.form');
    //     // }
    //     // if (auth()->check() && !auth()->user()->password_changed) {
    //     //     // Redirect the user to the password change page
    //     //     // return redirect()->route('password.change');
    //     //     return redirect()->route('password.change.form');
    //     //     // return route('login');
    //     // }
    //     foreach($guards as $guard){
    //         if(Auth::guard($guard)->check() && !Auth::user()->password_changed){
    //             return redirect()->route('password.change.form');
    //         }
    //     }
    //     return $next($request);
    // }

}
