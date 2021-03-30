<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BackendUserController extends Controller
{
    protected $folder = 'backend.user.';

    public function index() 
    {
        $users = User::orderByDesc('id')->paginate(20);

        $viewData = [
            'users' => $users
        ];

        return view($this->folder.'index', $viewData);
    }

    public function create() 
    {
        return view($this->folder.'create');
    }

    public function store() 
    {

    }

    public function edit($id) 
    {
        return view($this->folder.'update');
    }

    public function update($id) 
    {

    }

    public function delete($id) 
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('get_backend.user.index');
    }
}
