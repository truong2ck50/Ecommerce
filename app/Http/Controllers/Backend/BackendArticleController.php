<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendArticleRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Article;
use Illuminate\Support\Facades\DB;;
use Illuminate\Http\Request;

class BackendArticleController extends Controller
{
    protected $folder = 'backend.article.';

    public function index() {
        $articles = Article::orderByDesc('id')->paginate(20);

        $viewData = [
            'articles' => $articles
        ];

        return view($this->folder.'index', $viewData);
    }

    public function create() {
        $menus    = Menu::all();
        $viewData = [
            'menus' => $menus
        ];

        return view($this->folder.'create', $viewData);
    }

    public function store(BackendArticleRequest $request) {
        $data               = $request->except('_token','a_avatar');
        $data['a_slug']     = Str::slug($request->a_name);
        $data['created_at'] = Carbon::now();
        $article            = Article::create($data);

        return redirect()->route('get_backend.article.index');
    }

    public function edit($id) {
        $menus     = Menu::all();
        $article   = Article::find($id);
        $viewData  = [
            'menus'     => $menus,
            'article'   => $article
        ];

        return view($this->folder.'update', $viewData);
    }

    public function update(BackendArticleRequest $request, $id) {
        $data               = $request->except('_token','a_avatar');
        $data['a_slug']   = Str::slug($request->a_name);
        $data['updated_at'] = Carbon::now();
        Article::find($id)->update($data);

        return redirect()->route('get_backend.article.index');
        // return redirect()->back();
    }

    public function delete($id) {
        DB::table('articles')->where('id', $id)->delete();
        return redirect()->back();
    }
}
