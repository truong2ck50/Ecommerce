<?php

namespace App\Http\Middleware;

class CheckLoginUser
{
    public function handle($request, \Closure $next)
    {
        if(get_data_user('web')) return($next($request));

        return redirect()->route('get.login');
    }
}