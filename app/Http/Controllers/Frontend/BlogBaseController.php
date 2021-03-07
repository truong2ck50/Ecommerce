<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;

class BlogBaseController extends Controller
{
    public function getMenus()
    {
        $menus = Menu::withCount('articles')
        ->orderByDesc('id')
        ->get();

        return $menus;
    }

    public function getTags()
    {
        return Tag::orderByDesc('id')->get();
    }

    public function getArticlesLatest()
    {
        return Article::orderByDesc('id')
            ->limit(4)
            ->select('id', 'a_name', 'a_avatar', 'a_slug')
            ->get();
    }
}
