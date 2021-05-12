<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class CheckAdminTotalLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $adminTotal = Admin::where('id', get_data_user('admins'))->first();

        if($adminTotal && $adminTotal->level == 1) return($next($request));

        return redirect()->route('get_backend.home')->with('danger', 'Quản lý mới có quyền sử dụng chức năng này');
    }
}
