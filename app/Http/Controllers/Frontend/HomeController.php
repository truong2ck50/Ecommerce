<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $productsHot = Product::where('pro_hot', Product::HOT)
        ->limit(8)
        ->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar')
        ->get();

        $slide = Slide::limit(1)->first();

        $viewData = [
            'slide'       => $slide,
            'productsHot' => $productsHot
        ];

        return view('frontend.home.index', $viewData);
    }
}
