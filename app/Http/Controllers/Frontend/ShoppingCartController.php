<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Transaction;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $products = Cart::content();
        $viewData = [
            'products' => $products
        ];
        return view('frontend.shopping.index', $viewData);
    }

    public function checkout()
    {
        $products = Cart::content();
        $viewData = [
            'products' => $products
        ];
        return view('frontend.shopping.checkout', $viewData);
    }

    public function pay(Request $request)
    {
        $dataTransaction                  = $request->except('_token');
        $dataTransaction['created_at']    = Carbon::now();
        $dataTransaction['t_total_money'] = (int)str_replace(',', '', Cart::subtotal(0));
        $transaction = Transaction::create($dataTransaction);
        
        if($transaction)
        {
            $products = Cart::content();
            foreach($products as $item)
            {
                Order::create([
                    'od_transaction_id' => $transaction->id,
                    'od_product_id'     => $item->id,
                    'od_qty'            => $item->qty,
                    'od_price'          => $item->price,
                    'created_at'        => Carbon::now()
                ]);
            }
        }

        Cart::destroy();

        return redirect()->route('get.home');
    }
}