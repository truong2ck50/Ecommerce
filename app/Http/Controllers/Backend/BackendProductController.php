<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendProductRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BackendProductController extends Controller
{
    protected $folder = 'backend.product.';

    public function index()
    {
        $products = Product::with('category:id,c_name')->orderByDesc('id')->get();

        $viewData = [
            'products' => $products
        ];

        return view($this->folder . 'index', $viewData);
    }

    public function create()
    {
        // $categories = Category::where('c_parent_id','<>', 0)->get();  
        $categories    = Category::all(); 
        $keywords      = Keyword::all();
        $manufacturers = Manufacturer::orderByDesc('id')->get();
        $viewData   = [
            'categories'    => $categories,
            'keywordOld'    => [],
            'manufacturers' => $manufacturers,
            'keywords'      => $keywords
        ];

        return view($this->folder . 'create', $viewData);
    }

    public function store(BackendProductRequest $request)
    {
        $data               = $request->except('_token', 'pro_avatar', 'keywords');
        $data['pro_slug']   = Str::slug($request->pro_name);
        $data['created_at'] = Carbon::now();
        if ($request->pro_avatar) {
            $image = upload_image('pro_avatar');
            if (isset($image['code'])) {
                $data['pro_avatar'] = $image['name'];
            }
        }
        $product            = Product::create($data);
        if($request->keywords)
        {
            $this->syncKeyword($request->keywords, $product->id);
        }

        return redirect()->route('get_backend.product.index')->with('success','Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        // $categories = Category::where('c_parent_id','<>', 0)->get();
        $categories = Category::all();
        $keywords   = Keyword::all();
        $product    = Product::find($id);
        $manufacturers = Manufacturer::orderByDesc('id')->get();
        $keywordOld   = DB::table('products_keywords')
            ->where('pk_product_id', $id)->pluck('pk_keyword_id')->toArray() ?? [];
        $viewData   = [
            'categories'    => $categories,
            'keywordOld'    => $keywordOld,
            'manufacturers' => $manufacturers,
            'product'       => $product,
            'keywords'      => $keywords
        ];
        return view($this->folder . 'update', $viewData);
    }

    public function syncKeyword($keywords, $productID)
    {
        if(!empty($keywords))
        {
            $datas = [];
            foreach($keywords as $keyword)
            {
                $datas[] = [
                    'pk_product_id' => $productID,
                    'pk_keyword_id' => $keyword
                ];
            }
            DB::table('products_keywords')->where('pk_product_id', $productID)->delete();
            DB::table('products_keywords')->insert($datas);
        }
    }

    public function update(BackendProductRequest $request, $id)
    {
        $data               = $request->except('_token', 'pro_avatar', 'keywords');
        $data['pro_slug']   = Str::slug($request->pro_name);
        $data['updated_at'] = Carbon::now();
        if ($request->pro_avatar) {
            $image = upload_image('pro_avatar');
            if (isset($image['code'])) {
                $data['pro_avatar'] = $image['name'];
            }
        }
        Product::find($id)->update($data);
        if($request->keywords)
        {
            $this->syncKeyword($request->keywords, $id);
        }

        return redirect()->route('get_backend.product.index')->with('success', 'Cập nhật sản phẩm thành công');
        // return redirect()->back();
    }

    public function delete($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Xoá sản phẩm thành công');
    }

    public function active($id)
    {
        $product = Product::find($id);

        $product->pro_active = $product->pro_active ? 0 : 1;
        $product->save();

        return redirect()->back();
    }
}
