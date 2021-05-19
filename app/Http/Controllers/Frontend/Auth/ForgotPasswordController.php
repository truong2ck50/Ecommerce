<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function getFormResetPassword()
    {
        $countProductFavorites = WishList::where('pf_user_id', get_data_user('web'))->count();

        $viewData = [
            'countProductFavorites' => $countProductFavorites
        ];

        return view('frontend.auth.passwords.email', $viewData);
    }

    public function sendCodeResetPassword(Request $request)
    {  
        $email = $request->emailResetPass;

        $checkUser = User::where('email', $email)->first();

        if(!$checkUser)
        {
            return redirect()->back()->with('danger', 'Khách hàng không tồn tại');
        }

        $code = bcrypt(md5(time().$email));

        $checkUser->code = $code;
        $checkUser->time_code = Carbon::now();
        $checkUser->save();

        $url = route('get.link.reset.password', ['code' => $checkUser->code, 'email' => $email]);

        $data = [
            'route' => $url
        ];
        
        Mail::send('frontend.email.reset_password', $data, function($message) use ($email) {
	        $message->to($email, 'Reset Password')->subject('Lấy lại mật khẩu!');
	    });

        return redirect()->back()->with('success', 'Link lấy lại mật khẩu đã được gửi vào email của bạn');
    }

    public function resetPassword(Request $request)
    {
        $code = $request->code;
        $email = $request->email;

        $checkUser = User::where([
            'code'  => $code,
            'email' => $email
        ])->first();

        if(!$checkUser)
        {
            return redirect('/')->with('danger', 'Đường dẫn lấy lại mật khẩu không đúng, vui lòng thử lại sau.');
        }

        //Check thời gian tạo code quá 3 phút chưa
        $now = Carbon::now();
        if($now->diffInMinutes($checkUser->time_code) > 3)
        {
            // $code = bcrypt(md5($now.$email));
            DB::table('users')->where('email', $email)->update(['code' => NULL]);
            return redirect('/')->with('danger', 'Quá thời gian, bạn vui lòng thử lại sau.');
        }

        $countProductFavorites = WishList::where('pf_user_id', get_data_user('web'))->count();

        $viewData = [
            'countProductFavorites' => $countProductFavorites
        ];

        return view('frontend.auth.passwords.reset', $viewData);
    }

    public function saveResetPassword(ResetPasswordRequest $request)
    {
        if($request->password)
        {
            $code = $request->code;
            $email = $request->email;

            $checkUser = User::where([
                'code'  => $code,
                'email' => $email
            ])->first();

            if(!$checkUser)
            {
                return redirect('/')->with('danger', 'Đường dẫn lấy lại mật khẩu không đúng, bạn vui lòng thử lại sau.');
            }

            $checkUser->password = bcrypt($request->password);
            $checkUser->save();

            return redirect()->route('get.login')->with('success', 'Mật khẩu đã thay đổi thành công.');
        }
    }
}
