<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index($id) 
    {
        $user = User::find($id);
        return view('user.profile.index', compact('user'));
    }
    
    public function update(Request $request, $id)
    {
        if(User::find($id)->update($request->except(['_token'])))
        {
            return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        }
        return redirect()->back()->with('danger', 'Cập nhật thông tin thất bại');
    }
}
