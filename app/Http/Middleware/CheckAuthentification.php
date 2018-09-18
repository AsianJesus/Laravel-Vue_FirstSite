<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthentification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->login = true;
        $request->user = "Elvin";
        return $next($request);
    }
    private function check_user($uid, $password_hash){

    }
}
