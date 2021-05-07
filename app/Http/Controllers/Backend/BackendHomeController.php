<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Article;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BackendHomeController extends Controller
{
    public function index() 
    {
        $countUser        = User::select('id')->count();
        $countProduct     = Product::select('id')->count();
        $countArticle     = Article::select('id')->count();
        $countTransaction = Transaction::select('id')->count();
        $transactions     = Transaction::orderByDesc('id')->limit(10)->get();
        $users            = User::orderByDesc('id')->limit(10)->get();

        //Doanh thu ngày
        $moneyDay = Transaction::whereDay('updated_at', date('d'))
        ->where('t_status', Transaction::STATUS_SUCCESS)
        ->sum('t_total_money');

        //Doanh thu tuần
        // $moneyWeek = Transaction::whereWeek('updated_at', date('w'))
        // ->where('t_status', Transaction::STATUS_SUCCESS)
        // ->sum('t_total_money');

        //Doanh thu tháng
        $moneyMonth = Transaction::whereMonth('updated_at', date('m'))
        ->where('t_status', Transaction::STATUS_SUCCESS)
        ->sum('t_total_money');

        //Doanh thu năm
        $moneyYear = Transaction::whereYear('updated_at', date('Y'))
        ->where('t_status', Transaction::STATUS_SUCCESS)
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

        $viewData   = [
            'countUser'        => $countUser,
            'countProduct'     => $countProduct,
            'countArticle'     => $countArticle,
            'countTransaction' => $countTransaction,
            'transactions'     => $transactions,
            'users'            => $users,
            'dataMoney'        => json_encode($dataMoney)
        ];
        return view('backend.index', $viewData);
    }
}
