<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
        
        if (Auth::attempt([
            'email'    => $user->email,
            'password' => $user->name
        ])) {
            return redirect()->route('get.home');
        }

        return redirect()->to('/');
    }
}
