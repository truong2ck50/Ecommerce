<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Article;
use App\Models\Transaction;
use App\Models\Vote;
use Illuminate\Http\Request;

class BackendHomeController extends Controller
{
    public function index() 
    {
        $votes            = Vote::orderByDesc('id')->with('user:id,name', 'product:id,pro_name')->limit(10)->get();
        $countUser        = User::select('id')->count();
        $countProduct     = Product::select('id')->count();
        $countArticle     = Article::select('id')->count();
        $countTransaction = Transaction::select('id')->count();
        $transactions     = Transaction::orderByDesc('id')->limit(10)->get();
        $users            = User::orderByDesc('id')->limit(10)->get();

        //Doanh thu ngày
        $moneyDay = Transaction::whereDay('updated_at', date('d'))
        ->where('t_status', Transaction::STATUS_DONE)
        ->sum('t_total_money');

        //Doanh thu tuần
        $date = \Carbon\Carbon::today()->subDays(7);
    
        $moneyWeek = Transaction::where('created_at','>=',$date)
        ->where('t_status', Transaction::STATUS_DONE)
        ->sum('t_total_money');

        //Doanh thu tháng
        $moneyMonth = Transaction::whereMonth('updated_at', date('m'))
        ->where('t_status', Transaction::STATUS_DONE)
        ->sum('t_total_money');

        //Doanh thu năm
        $moneyYear = Transaction::whereYear('updated_at', date('Y'))
        ->where('t_status', Transaction::STATUS_DONE)
        ->sum('t_total_money');

        $dataMoney = [
            [
            'name' => 'Doanh thu ngày',
            'y'    => (int)$moneyDay
            ],
            // [
            // 'name' => 'Doanh thu tuần',
            // 'y'    => (int)$moneyWeek
            // ],
            [
            'name' => 'Doanh thu tháng',
            'y'    => (int)$moneyMonth
            ],
            [
            'name' => 'Doanh thu năm',
            'y'    => (int)$moneyYear
            ]
            
        ];

        //Thống kê trạng thái đơn hàng
        //Chờ xử lý
        $transactionDefault = Transaction::where('t_status', 1)->select('id')->count();

        //Đã xử lý
        $transactionSuccess = Transaction::where('t_status', 2)->select('id')->count();

        //Hoàn thành
        $transactionDone = Transaction::where('t_status', 3)->select('id')->count();

        //Huỷ bỏ
        $transactionCancel = Transaction::where('t_status', -1)->select('id')->count();

        $dataTransaction = [
            [
            'name' => 'Tiếp nhận',
            'y'    => (int)$transactionDefault
            ],
            [
            'name' => 'Đã xử lý',
            'y'    => (int)$transactionSuccess
            ],
            [
            'name' => 'Hoàn thành',
            'y'    => (int)$transactionDone
            ],
            [
            'name' => 'Huỷ bỏ',
            'y'    => (int)$transactionCancel
            ]            
        ];

        $viewData   = [
            'votes'            => $votes,
            'countUser'        => $countUser,
            'countProduct'     => $countProduct,
            'countArticle'     => $countArticle,
            'countTransaction' => $countTransaction,
            'transactions'     => $transactions,
            'users'            => $users,
            'dataMoney'        => json_encode($dataMoney),
            'dataTransaction'  => json_encode($dataTransaction)
        ];
        return view('backend.index', $viewData);
    }
}
