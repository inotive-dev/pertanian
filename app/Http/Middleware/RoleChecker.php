<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $key => $value) {
            if (Auth::user()->user_role->role->name == $value) {    
                // dd($role->name);
                return $next($request);
            }
        }
         return redirect('login')->with('ERR',"Anda tidak dapat mengakses halaman ini");
    }
}
