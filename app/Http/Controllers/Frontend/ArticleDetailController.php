<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleDetailController extends BlogBaseController
{
    public function index() 
    {
        return view('frontend.article_detail.index');   
    }
}
