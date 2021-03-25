<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleDetailController extends BlogBaseController
{
    public function index(Request  $request, $slug) 
    {
        $article = Article::where('a_slug', $slug)->first();
        if(!$article) return abort(404);

        $articleNext = Article::where('id', '>', $article->id)->limit(1)->orderByDesc('id', 'asc')->first();
        $articlePrev = Article::where('id', '<', $article->id)->limit(1)->orderBy('id', 'desc')->first();

        $viewData = [
            'article'        => $article,
            'articleNext'    => $articleNext,
            'articlePrev'    => $articlePrev,
            'tags'           => $this->getTags(),
            'articlesLatest' => $this->getArticlesLatest(),
            'menus'          => $this->getMenus()
        ];

        return view('frontend.article_detail.index', $viewData);   
    }
}
