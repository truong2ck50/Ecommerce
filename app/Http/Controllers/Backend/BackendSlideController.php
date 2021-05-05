<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BackendSlideController extends Controller
{
    protected $folder = 'backend.slide.';

    public function index() 
    {
        $slides   = Slide::orderByDesc('id')->get();
        $viewData = [
            'slides' => $slides
        ];

        return view($this->folder.'index', $viewData);
    }

    public function store(Request $request) 
    {
        $data               = $request->except('_token', 's_banner');
        $data['created_at'] = Carbon::now();
        if($request->s_banner)
        {
            $image = upload_image('s_banner');
            if(isset($image['code']))
            {
                $data['s_banner'] = $image['name'];
            }
        }
        $slide = Slide::create($data);

        return redirect()->back()->with('success','Thêm banner thành công');
    }

    public function edit($id) 
    {
        $slides   = Slide::orderByDesc('id')->get();
        $slide    = Slide::find($id);
        $viewData = [
            'slides' => $slides,
            'slide'  => $slide
        ];
        
        return view($this->folder.'update', $viewData);
    }

    public function update(Request $request, $id) 
    {
        $data               = $request->except('_token', 's_banner');
        $data['updated_at'] = Carbon::now();
        if($request->s_banner)
        {
            $image = upload_image('s_banner');
            if(isset($image['code']))
            {
                $data['s_banner'] = $image['name'];
            }
        }
        Slide::find($id)->update($data);

        return redirect()->route('get_backend.slide.index')->with('success','Cập nhật banner thành công');
    }

    public function delete($id) 
    {
        DB::table('slides')->where('id', $id)->delete();
        return redirect()->route('get_backend.slide.index')->with('success','Xoá banner thành công');
    }
}
