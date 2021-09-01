<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class BackendWarehouseController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category:id,c_name');

        if($request->type == 'pay')
        {
            $products->where('pro_pay', '>', 5)->orderByDesc('pro_pay');
        }
        elseif($request->type == 'outOfStock')
        {
            $products->where('pro_number', '<=', 5)->orderByDesc('pro_number');
        }
        else
        {
            $products->where('pro_number', '>=', 20)->orderByDesc('pro_number');
        }

        $products = $products->paginate(10);

        $viewData = [
            'products' => $products
        ];

        return view('backend.warehouse.index', $viewData);
    }
}
