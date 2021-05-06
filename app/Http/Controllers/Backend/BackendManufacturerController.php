<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\BackendManufacturerRequest;

class BackendManufacturerController extends Controller
{
    protected $folder = 'backend.manufacturer.';

    public function index() 
    {
        $manufacturers = Manufacturer::orderByDesc('id')->get();

        $viewData = [
            'manufacturers' => $manufacturers
        ];

        return view($this->folder.'index', $viewData);
    }

    public function store(BackendManufacturerRequest $request) 
    {
        $data               = $request->except('_token');
        $data['m_slug']     = Str::slug($request->m_name);
        $data['created_at'] = Carbon::now();
        $manufacturer       = Manufacturer::create($data);

        return redirect()->route('get_backend.manufacturer.index')->with('success','Thêm hãng sản phẩm thành công');
    }

    public function edit($id) 
    {
        $manufacturer       = Manufacturer::find($id);
        $manufacturers      = Manufacturer::orderByDesc('id')->get();
        $viewData  = [
            'manufacturers' => $manufacturers,
            'manufacturer'  => $manufacturer
        ];

        return view($this->folder.'update', $viewData);
    }

    public function update(BackendManufacturerRequest $request, $id) 
    {
        $data               = $request->except('_token');
        $data['m_slug']     = Str::slug($request->m_name);
        $data['updated_at'] = Carbon::now();
        Manufacturer::find($id)->update($data);

        return redirect()->route('get_backend.manufacturer.index')->with('success','Cập nhật hãng sản phẩm thành công');
    }

    public function delete($id) 
    {
        DB::table('manufacturers')->where('id', $id)->delete();
        return redirect()->route('get_backend.manufacturer.index')->with('success','Xoá hãng sản phẩm thành công');
    }
}
