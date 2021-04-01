<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productsHot = Product::where('pro_hot', Product::HOT)
            ->limit(6)
            ->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar')
            ->get();

        $productsNews = Product::where('pro_hot', Product::HOT)
            ->limit(6)
            ->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar')
            ->orderByDesc('id')
            ->get();

        $slide = Slide::limit(1)->first();
        $categoriesHot = Category::where('c_hot', Category::HOT)->orderByDesc('id')->limit(4)->get();

        $viewData = [
            'slide'         => $slide,
            'categoriesHot' => $categoriesHot,
            'productsHot'   => $productsHot,
            'productsNews'  => $productsNews
        ];

        return view('frontend.home.index', $viewData);
    }
}
