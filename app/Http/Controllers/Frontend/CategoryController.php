<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends ProductBaseController
{
    public function index(Request $request, $slug)  
    {
        $category = Category::where('c_slug', $slug)->first();
        if(!$category) return abort(404);

        $products = Product::where('pro_category_id', $category->id)
        ->limit(8)
        ->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar')
        ->paginate(12);

        $viewData = [
            'title'          => $category->c_name,
            'category'       => $category,
            'categoriesSort' => $this->getCategoriesSort(),
            'products'       => $products
        ];

        return view('frontend.category.index', $viewData);
    }
}
