<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendArticleRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Support\Facades\DB;;
use Illuminate\Http\Request;

class BackendArticleController extends Controller
{
    protected $folder = 'backend.article.';

    public function index() 
    {
        $articles = Article::with('menu:id,mn_name')->orderByDesc('id')->get();

        $viewData = [
            'articles' => $articles
        ];

        return view($this->folder.'index', $viewData);
    }

    public function create() 
    {
        $menus    = Menu::all();
        $tags     = Tag::all();
        $viewData = [
            'tags'    => $tags,
            'menus'   => $menus,
            'tagsOld' => []
        ];

        return view($this->folder.'create', $viewData);
    }

    public function store(BackendArticleRequest $request) 
    {
        $data               = $request->except('_token','a_avatar', 'tags');
        $data['a_slug']     = Str::slug($request->a_name);
        $data['created_at'] = Carbon::now();
        if($request->a_avatar)
        {
            $image = upload_image('a_avatar');
            if(isset($image['code']))
            {
                $data['a_avatar'] = $image['name'];
            }
        }
        $article            = Article::create($data);
        if($request->tags)
            $this->syncTags($request->tags, $article->id);

        return redirect()->route('get_backend.article.index')->with('success','Thêm bài viết thành công');
    }

    public function edit($id) 
    {
        $menus     = Menu::all();
        $article   = Article::find($id);
        $tags      = Tag::all();
        $tagsOld   = DB::table('articles_tags')
            ->where('at_article_id', $id)->pluck('at_tag_id')->toArray() ?? [];

        $viewData  = [
            'menus'     => $menus,
            'tags'      => $tags,
            'article'   => $article,
            'tagsOld'   => $tagsOld
        ];

        return view($this->folder.'update', $viewData);
    }

    public function syncTags($tags, $articleID)
    {
        if(!empty($tags))
        {
            $datas = [];
            foreach($tags as $tag)
            {
                $datas[] = [
                    'at_article_id' => $articleID,
                    'at_tag_id'     => $tag
                ];
            }
            DB::table('articles_tags')->where('at_article_id', $articleID)->delete();
            DB::table('articles_tags')->insert($datas);
        }
    }

    public function update(BackendArticleRequest $request, $id) 
    {
        $data               = $request->except('_token','a_avatar', 'tags');
        $data['a_slug']   = Str::slug($request->a_name);
        $data['updated_at'] = Carbon::now();
        if($request->a_avatar)
        {
            $image = upload_image('a_avatar');
            if(isset($image['code']))
            {
                $data['a_avatar'] = $image['name'];
            }
        }
        Article::find($id)->update($data);
        if($request->tags)
            $this->syncTags($request->tags, $id);

        return redirect()->route('get_backend.article.index')->with('success','Cập nhật bài viết thành công');
        // return redirect()->back();
    }

    public function delete($id) 
    {
        DB::table('articles')->where('id', $id)->delete();
        return redirect()->route('get_backend.article.index')->with('success','Xoá bài viết thành công');;
    }
}
