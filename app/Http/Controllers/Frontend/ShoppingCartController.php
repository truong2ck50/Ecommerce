<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Transaction;
use App\Models\WishList;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $products = Cart::content();
        $countProductFavorites = $countProductFavorites = WishList::where('pf_user_id', get_data_user('web'))->count();

        $viewData = [
            'products'              => $products,
            'countProductFavorites' => $countProductFavorites
        ];
        return view('frontend.shopping.index', $viewData);
    }

    public function checkout()
    {
        $products = Cart::content();
        $user = User::find(get_data_user('web'));
        $countProductFavorites = WishList::where('pf_user_id', get_data_user('web'))->count();
        
        if(Cart::count() < 1)
        {
            $viewData = [
                'user'                  => $user,
                'message'               => 'Giỏ hàng trống',
                'products'              => $products,
                'countProductFavorites' => $countProductFavorites
            ];
            return view('frontend.shopping.index', $viewData);
        } else {
            
            $viewData = [
                'user'                  => $user,
                'products'              => $products,
                'countProductFavorites' => $countProductFavorites
            ];
        return view('frontend.shopping.checkout', $viewData);
        }
    }


    public function pay(Request $request)
    {
        $data['t_user_id'] = get_data_user('web');
        $data['t_total_money'] = (int)str_replace(',', '', Cart::subtotal(0));
        $data['created_at']    = Carbon::now();

        if($request->payment == 2)
        {        
            $totalMoney = (int)str_replace(',', '', Cart::subtotal(0));
            session(['info_customer' => $data]);
            $viewData   = [
                'totalMoney' => $totalMoney
            ];
            
            return view('frontend.vnpay.index', $viewData);
        } 
        else
        {
            if(Cart::count() > 0)
            {
                $dataTransaction                  = $request->except('_token');
                $dataTransaction['created_at']    = Carbon::now();
                $dataTransaction['t_user_id']     = get_data_user('web') ?? 0;
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
                            'od_price'          => $item->options->price_old,
                            'od_sale'           => $item->options->sale,
                            'created_at'        => Carbon::now()
                        ]);
                    }
                }

                Cart::destroy();
                return redirect()->route('get_user.transaction.index')->with('success', 'Đặt hàng thành công.');
            }
            
            return redirect()->route('get_user.transaction.index');
        }
    }

    public function createPayment(Request $request)
    {
        $vnp_TxnRef = $request->order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $vnp_TmnCode = "1TKJ3HFV";
        $vnp_HashSecret = "PBKLMEDUKBSQVTJTSEPASCOVJDXMVAFT";
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
        // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);

    }

    public function vnpayReturn(Request $request)
    {
        if($request->vnp_ResponseCode == '00')
        {
            $vnpayData = $request->all();
            $idUser    = get_data_user('web');
            $user      = User::find($idUser);
            if(Cart::count() > 0)
            {
                $dataTransaction['t_name']        = $user->name;
                $dataTransaction['t_email']       = $user->email;
                $dataTransaction['t_phone']       = $user->phone;
                $dataTransaction['t_address']     = $user->address;
                $dataTransaction['t_status']      = 2;
                $dataTransaction['t_note']        = 'Thanh toán online tại VNPAY';
                $dataTransaction['created_at']    = Carbon::now();
                $dataTransaction['t_user_id']     = get_data_user('web') ?? 0;
                $dataTransaction['t_total_money'] = (int)str_replace(',', '', Cart::subtotal(0));
                $transaction                      = Transaction::create($dataTransaction);
            
                if($transaction)
                {
                    $products = Cart::content();
                    foreach($products as $item)
                    {
                        Order::create([
                            'od_transaction_id' => $transaction->id,
                            'od_product_id'     => $item->id,
                            'od_qty'            => $item->qty,
                            'od_price'          => $item->options->price_old,
                            'od_sale'           => $item->options->sale,
                            'created_at'        => Carbon::now()
                        ]);
                    }
                    
                    Payment::create([
                        'p_transaction_id'    => $transaction->id,
                        'p_transaction_code'  => $request->vnp_TxnRef,
                        'p_user_id'           => $transaction->t_user_id,
                        'p_money'             => $transaction->t_total_money,
                        'p_note'              => $request->vnp_OrderInfo,
                        'p_vnp_response_code' => $request->vnp_ResponseCode,
                        'p_code_vnpay'          => $request->vnp_TransactionNo,
                        'p_code_bank'         => $request->vnp_BankCode,
                        'p_time'              => date('Y-m-d H:i:s', strtotime($request->vnp_PayDate)),
                        'created_at'          => Carbon::now()
                    ]);
                }
            }


            Cart::destroy();

            return view('frontend.vnpay.vnpay_return', compact('vnpayData'));
        }
    }
}
