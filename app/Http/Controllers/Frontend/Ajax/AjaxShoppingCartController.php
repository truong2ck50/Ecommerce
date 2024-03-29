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
            $qty     = $request->qty;
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
                    'message' => 'Sản phẩm tạm hết hàng'
                ]);
            }

            if($product->pro_number < $qty)
            {
                return response()->json([
                    'status'  => 200,
                    'message' => 'Số lượng sản phẩm không đủ'
                ]);
            }

            $cart = Cart::content();

            $idCartProduct = $cart->search(function ($cartItem) use ($product) {
                if($cartItem->id == $product->id) return $cartItem->id;
            });

            if($idCartProduct) {
                $productByCart = Cart::get($idCartProduct);
                if($product->pro_number < ($productByCart->qty + $qty))
                {
                    return response()->json([
                        'status'  => 200,
                        'message' => 'Số lượng sản phẩm không đủ'
                    ]);
                }
            }

            //Thêm vào giỏ hàng

            $price = $product->pro_price;
            if($product->pro_sale)
            {
                $price = $price * (100 - $product->pro_sale) / 100;
            }
            
            Cart::add([
                'id'      => $product->id,
                'name'    => $product->pro_name,
                'qty'     => $qty,
                'price'   => $price,
                'weight'  => '1',
                'options' => [
                    'sale'      => $product->pro_sale,
                    'price_old' => $product->pro_price,
                    'image'     => $product->pro_avatar
                ]
            ]);
            return response()->json([
                'status'    => 200,
                'totalCart' => Cart::count(),
                'message'   => 'Thêm sản phẩm thành công'
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
        if($request->ajax())
        {
            return response()->json([
                Cart::remove($id),
                'totalCart' => Cart::count(),
                'status' => 200,
                'message'   => 'Xoá sản phẩm thành công'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
       if($request->ajax())
       {
           Cart::update($id, $request->qty);
           return response()->json([
                'status' => 200,
                'message'   => 'Cập nhật giỏ hàng thành công',
                'totalCart' => Cart::count()
           ]);
       } 
    }
}