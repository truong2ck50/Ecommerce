<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;

class BackendTransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::orderByDesc('id')->paginate(20);
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
}
