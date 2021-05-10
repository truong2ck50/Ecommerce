<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BackendTransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::orderByDesc('id')->get();
        $viewData = [
            'transactions' => $transactions
        ];

        return view('backend.transaction.index', $viewData);
    }

    public function view($id)
    {
        $transaction = Transaction::find($id);
        $orders      = Order::with('product')->where('od_transaction_id', $id)->get();
        $viewData    = [
            'transaction' => $transaction,
            'orders'      => $orders
        ];

        return view('backend.transaction.item', $viewData);
    }

    //Xử lý trạng thái đơn hàng
    public function success($id)
    {
        $transaction = Transaction::find($id);
        $orders = Order::where('od_transaction_id', $id)->get();

        if($orders)
        {
            foreach($orders as $order)
            {
                $product = Product::find($order->od_product_id);
                //Trừ đi số lượng sản phẩm
                if($product->pro_number < $order->od_qty)
                {
                    return redirect()->back()->with('danger', 'Vui lòng nhập thêm hàng để tiếp tục xử lý');
                }
                $product->pro_number = $product->pro_number - $order->od_qty;
                $product->save();
            }
        }
        //Cập nhật trạng thái đơn hàng
        $transaction->t_status = Transaction::STATUS_SUCCESS;
        $transaction->save();
        return redirect()->back()->with('success', 'Xử lý đơn hàng thành công');
    }

    //Đã thanh toán
    public function done($id)
    {
        $transaction = Transaction::find($id);
        $orders = Order::where('od_transaction_id', $id)->get();

        if($orders)
        {
            foreach($orders as $order)
            {
                $product = Product::find($order->od_product_id);
                //Tăng biến pro_pay
                $product->pro_pay = $order->product->pro_pay + $order->od_qty;
                $product->save();
            }
        }

        //Tăng total_pay user & cập nhật trạng thái đơn hàng
        DB::table('users')->where('id', $transaction->t_user_id)->increment('total_pay');
        $transaction->t_status = Transaction::STATUS_DONE;
        $transaction->save();

        return redirect()->back()->with('success', 'Xác nhận thanh toán thành công');
    }

    public function cancel($id)
    {
        $transaction = Transaction::find($id);
        
        $orders = Order::where('od_transaction_id', $id)->get();

        if($orders)
        {
            foreach($orders as $order)
            {
                $product = Product::find($order->od_product_id);
                //Cộng lại số lượng sản phẩm đã xử lý nếu huỷ bỏ
                if($transaction->t_status != Transaction::STATUS_DEFAULT)
                {
                    $product->pro_number = $product->pro_number + $order->od_qty;
                }
                else
                {
                    $product->pro_number = $product->pro_number;
                }

                $product->save();
            }
        }

        //Cập nhật trạng thái đơn hàng
        $transaction->t_status = Transaction::STATUS_CANCEL;
        $transaction->save();
        return redirect()->back()->with('success', 'Huỷ đơn hàng thành công');
    }

    public function delete($id)
    {
        $orders = Order::where('od_transaction_id', $id)->get();
        if($orders)
        {
            foreach ($orders as $item) {
                DB::table('orders')->where('id', $item->id)->delete();
            }
        }

        DB::table('transactions')->where('id', $id)->delete();
        return redirect()->back()->with('success','Xoá đơn hàng thành công');
    }
}
