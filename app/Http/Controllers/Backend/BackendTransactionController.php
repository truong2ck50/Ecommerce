<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
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

    public function success($id)
    {
        $transaction = Transaction::find($id);
        $transaction->t_status = Transaction::STATUS_SUCCESS;
        $transaction->save();
        return redirect()->back();
    }

    public function cancel($id)
    {
        $transaction = Transaction::find($id);
        $transaction->t_status = Transaction::STATUS_CANCEL;
        $transaction->save();
        return redirect()->back();
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
        return redirect()->back()->with('success','Xoá đơn hàng thành công!');
    }
}
