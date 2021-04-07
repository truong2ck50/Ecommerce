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

        $viewData   = [
            'countUser'        => $countUser,
            'countProduct'     => $countProduct,
            'countArticle'     => $countArticle,
            'countTransaction' => $countTransaction,
            'transactions'     => $transactions,
            'users'            => $users
        ];
        return view('backend.index', $viewData);
    }
}
