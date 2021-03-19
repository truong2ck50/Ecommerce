<?php

namespace App\Http\Controllers\Frontend\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;


class AjaxShoppingCartController extends Controller
{
    public function add(Request $request, $productID)
    {
       if($request->ajax())
        {
            //Kiểm tra sản phẩm
            $product = Product::find($productID);
            if(!$product)
            {
                return response()->json([
                    'status' => 404
                ]);
            }

            //Kiểm tra số lượng sản phẩm
            if($product->pro_number < 1)
            {
                return response()->json([
                    'status'  => 200,
                    'message' => 'Số lượng không đủ'
                ]);
            }

            $cart = Cart::content();

            $idCartProduct = $cart->search(function ($cartItem) use ($product) {
                if($cartItem->id == $product->id) return $cartItem->id;
            });

            if($idCartProduct) {
                $productByCart = Cart::get($idCartProduct);
                if($product->pro_number < ($productByCart->qty + 1))
                {
                    return response()->json([
                        'status'  => 200,
                        'message' => 'Số lượng không đủ'
                    ]);
                }
            }

            //Thêm vào giỏ hàng
            Cart::add([
                'id'      => $product->id,
                'name'    => $product->pro_name,
                'qty'     => 1,
                'price'   => $product->pro_price,
                'weight'  => '1',
                'options' => [
                    // 'sale' => $product->pro_sale,
                    // 'price_old' => $product->pro_price,
                    'image' => $product->pro_avatar
                ]
            ]);
            return response()->json([
                'status'  => 200,
                'message' => 'Thêm sản phẩm thành công'
            ]);
        }
    }
}