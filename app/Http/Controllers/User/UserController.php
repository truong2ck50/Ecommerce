<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('t_user_id', get_data_user('web'))
        ->paginate(10);

        $totalTransaction = Transaction::where('t_user_id', get_data_user('web'))
        ->select('id')
        ->count();

        $totalTransactionDone = Transaction::where('t_user_id', get_data_user('web'))
        ->where('t_status', Transaction::STATUS_SUCCESS)
        ->select('id')
        ->count();

        $totalTransactionCancel = Transaction::where('t_user_id', get_data_user('web'))
        ->where('t_status', Transaction::STATUS_CANCEL)
        ->select('id')
        ->count();

        $viewData = [
            'totalTransaction'       => $totalTransaction,
            'totalTransactionDone'   => $totalTransactionDone,
            'totalTransactionCancel' => $totalTransactionCancel,
            'transactions'           => $transactions
        ];
        return view('user.index', $viewData);
    }

    public function updatePassword()
    {
        return view('user.password.index');
    }

    public function saveUpdatePassword(PasswordRequest $request)
    {
        if(Hash::check($request->password_old, get_data_user('web', 'password')))
        {
            $user = User::find(get_data_user('web'));
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Cập nhật mật khẩu thành công');
        }

        return redirect()->back()->with('danger', 'Mật khẩu cũ không đúng');
    }
}
