<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('frontend.auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password); // Mã hoá password (Hash password)
        $data['created_at'] = Carbon::now();
        $user = User::create($data);

        if(Auth::loginUsingId($user->id))
        {
            return redirect()->route('get.home');
        }
        return redirect()->back();
    }
}
