@extends('layouts.app_blog')
@section('title', 'Bài viết')
@section('content')
    <div class="container">
            <div class="row">
                <!-- Latest Posts -->
                <main class="posts-listing col-lg-8">
                    <div class="container">
                        <div class="row">
                            <!-- post -->
                            @foreach($articles as $article)
                                @include('frontend.components._inc_article_item', ['item' => $article])
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <!-- <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-template d-flex justify-content-center">
                                <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
                                <li class="page-item"><a href="#" class="page-link active">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav> -->
                    </div>
                </main>
                <aside class="col-lg-4">
                    <!-- Widget [Search Bar Widget]-->
                    <div class="widget search">
                        <header>
                            <h3 class="h6">Search the blog</h3>
                        </header>
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <input type="search" placeholder="What are you looking for?">
                                <button type="submit" class="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Widget [Latest Posts Widget]        -->
                    <div class="widget latest-posts">
                        <header>
                            <h3 class="h6">Bài viết mới nhất</h3>
                        </header>
                        <div class="blog-posts">
                            @foreach($articlesLatest ?? [] as $item)
                            <a href="{{ route('get.article_detail', ['slug' => $item->a_slug]) }}" title="{{ $item->a_name }}">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{ pare_url_file($item->a_avatar) }}" alt="{{ $item->a_name }}" class="img-fluid">
                                    </div>
                                    <div class="title">
                                        <strong>{{ $item->a_name }}</strong>
                                        <div class="d-flex align-items-center">
                                            <div class="views"><i class="icon-eye"></i> 500</div>
                                            <div class="comments"><i class="icon-comment"></i>12</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Widget [Categories Widget]-->
                    <div class="widget categories">
                        <header>
                            <h3 class="h6">Menus</h3>
                        </header>
                        @foreach($menus ?? [] as $item)
                            <div class="item d-flex justify-content-between">
                                <a href="{{ route('get.menu', ['slug' => $item->mn_slug]) }}" title="{{ $item->mn_name }}">{{ $item->mn_name }}</a>
                                <span>{{ $item->articles_count }}</span>
                            </div>
                        @endforeach
                    </div>
                    <!-- Widget [Tags Cloud Widget]-->
                    <div class="widget tags">
                        <header>
                            <h3 class="h6">Tags</h3>
                        </header>
                        <ul class="list-inline">
                            @foreach($tags ?? [] as $item)
                            <li class="list-inline-item">
                                <a href="#" class="tag">#{{ $item->t_name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
@stop