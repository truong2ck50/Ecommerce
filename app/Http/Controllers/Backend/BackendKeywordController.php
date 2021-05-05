<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendKeywordRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BackendKeywordController extends Controller
{
    protected $folder = 'backend.keyword.';

    public function index() 
    {
        $keywords = Keyword::orderByDesc('id')->get();
        $viewData = [
            'keywords' => $keywords
        ];

        return view($this->folder.'index', $viewData);
    }

    public function store(BackendKeywordRequest $request) 
    {
        $data               = $request->except('_token');
        $data['k_slug']     = Str::slug($request->k_name);
        $data['created_at'] = Carbon::now();
        $keyword            = Keyword::create($data);

        return redirect()->route('get_backend.keyword.index')->with('success','Thêm từ khoá thành công');
    }

    public function edit($id) 
    {
        $keyword       = Keyword::find($id);
        $keywords      = Keyword::orderByDesc('id')->get();
        $viewData  = [
            'keywords' => $keywords,
            'keyword'  => $keyword
        ];

        return view($this->folder.'update', $viewData);
    }

    public function update(BackendKeywordRequest $request, $id) 
    {
        $data               = $request->except('_token');
        $data['k_slug']     = Str::slug($request->k_name);
        $data['updated_at'] = Carbon::now();
        Keyword::find($id)->update($data);

        return redirect()->route('get_backend.keyword.index')->with('success','Cập nhật từ khoá thành công');
    }

    public function delete($id) 
    {
        DB::table('keywords')->where('id', $id)->delete();
        return redirect()->route('get_backend.keyword.index')->with('success','Xoá từ khoá thành công');
    }
}
