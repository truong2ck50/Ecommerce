<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vote;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index(Request $request, $slug) 
    {
        $product = Product::with('category:id,c_name,c_slug', 'keywords')->where('pro_slug', $slug)->first();
        if(!$product) return abort(404);

        $productsRelated = Product::where('pro_category_id', $product->pro_category_id)
        ->where('id', '<>', $product->id)
        ->limit(8)
        ->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar')
        ->get();

        $votes = Vote::with('user')->where('v_product_id', $product->id)->get();

        $viewData = [
            'product'         => $product,
            'votes'           => $votes,  
            'productsRelated' => $productsRelated
        ];
        return view('frontend.product_detail.index', $viewData);
    }
}
