<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\BackendStaffRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BackendStaffController extends Controller
{
    protected $folder = 'backend.staff.';

    public function index() 
    {
        $staffs = Admin::where('level', '<>', '1')->orderByDesc('id')->get();

        $viewData = [
            
            'staffs' => $staffs
        ];

        return view($this->folder.'index', $viewData);
    }

    public function store(BackendStaffRequest $request) 
    {
        $data               = $request->except('_token');
        $data['password']   = bcrypt($request->password);
        $data['level']      = 2;
        $data['created_at'] = Carbon::now();
        
        $staffs = Admin::create($data);

        return redirect()->route('get_backend.staff.index')->with('success','Thêm nhân viên thành công');
    }

    public function edit($id) 
    {
        $staffs         = Admin::where('level', '<>', '1')->orderByDesc('id')->get();
        $staff          = Admin::find($id);

        $viewData   = [
            'staffs'       => $staffs,
            'staff'        => $staff,
        ];
        
        return view($this->folder.'update', $viewData);
    }

    public function update(BackendStaffRequest $request, $id) 
    {
        $data               = $request->except('_token');
        $data['updated_at'] = Carbon::now();
        
        Admin::find($id)->update($data);

        return redirect()->route('get_backend.staff.index')->with('success','Cập nhật nhân viên thành công');;
    }

    public function delete($id) 
    {
        DB::table('admins')->where('id', $id)->delete();
        return redirect()->route('get_backend.staff.index')->with('success','Xoá nhân viên thành công');;
    }
}
