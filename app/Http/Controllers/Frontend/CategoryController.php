<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;

class CategoryController extends ProductBaseController
{
    public function index(Request $request, $slug)  
    {
        $category = Category::where('c_slug', $slug)->first();
        if(!$category) return abort(404);

        $products = Product::where(['pro_category_id' => $category->id, 'pro_active' => Product::STATUS_PUBLIC]);

        $countProductFavorites = WishList::where('pf_user_id', get_data_user('web'))->count();

        if($name = $request->k)
        {
            $products->where('pro_name', 'like', '%'. $name .'%');
        }

        if($request->m)
        {
            $products->where('pro_manufacturer_id', $request->m);
        }

        if($request->price)
        {
            $price = $request->price;
            switch($price)
            {
                case '1':
                    $products->where('pro_price', '<', 1000000);
                    break;
                
                case '2':
                    $products->whereBetween('pro_price', [1000000, 5000000]);
                    break;

                case '3':
                    $products->whereBetween('pro_price', [5000000, 10000000]);
                    break;

                case '4':
                    $products->whereBetween('pro_price', [10000000, 15000000]);
                    break;
                
                case '5':
                    $products->where('pro_price', '>', 15000000);
                    break;
            }
        }

        if($request->sorting)
        {
            $sorting = $request->sorting;

            switch($sorting)
            {
                case 'desc':
                    $products->orderByDesc('id');
                    break;
                
                case 'low-high':
                    $products->orderBy('pro_price', 'ASC');
                    break;
                
                case 'high-low':
                    $products->orderBy('pro_price', 'DESC');
                    break;

                default:
                    $products->orderByDesc('id');
                    break;
            }
        }

        $products = $products->select('id', 'pro_name', 'pro_slug', 'pro_price', 'pro_avatar', 'pro_sale')
        ->paginate(12);
        

        $viewData = [
            'title'                 => $category->c_name,
            'category'              => $category,
            'query'                 => $request->query(),
            'categoriesSort'        => $this->getCategoriesSort(),
            'products'              => $products,
            'countProductFavorites' => $countProductFavorites
        ];

        return view('frontend.category.index', $viewData);
    }
}
