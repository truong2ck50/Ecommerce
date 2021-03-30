<?php

namespace App\Http\Middleware;

class CheckLoginAdmin
{
    public function handle($request, \Closure $next)
    {
        if(get_data_user('admins')) return($next($request));

        return redirect()->route('get_admin.login');
    }
}