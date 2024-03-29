<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Category;
use App\Models\WishList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productsHot = Product::where(['pro_hot' => Product::HOT, 'pro_active'=> Product::STATUS_PUBLIC])
            ->limit(6)
            ->orderByDesc('id')
            ->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar', 'pro_sale')
            ->get();

        $productsNews = Product::limit(6)
            ->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar', 'pro_sale')
            ->orderByDesc('id')
            ->get();

        $slide = Slide::limit(1)->first();
        $categoriesHot = Category::where('c_hot', Category::HOT)->orderByDesc('id')->limit(4)->get();

        $countProductFavorites = WishList::where('pf_user_id', get_data_user('web'))->count();
        

        $viewData = [
            'slide'                 => $slide,
            'categoriesHot'         => $categoriesHot,
            'productsHot'           => $productsHot,
            'productsNews'          => $productsNews,
            'countProductFavorites' => $countProductFavorites
        ];

        return view('frontend.home.index', $viewData);
    }
}
