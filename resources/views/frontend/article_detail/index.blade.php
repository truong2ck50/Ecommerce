@extends('layouts.app_blog')
@section('title', $article->a_name)
@section('content')
    <div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8">
            <div class="container">
                <div class="post-single">
                    <div class="post-thumbnail"><img src="{{ pare_url_file($article->a_avatar) }}" alt="{{ $article->a_name }}" class="img-fluid"></div>
                    <div class="post-details">
                        <!-- <div class="post-meta d-flex justify-content-between">
                            <div class="category"><a href="#">Business</a><a href="#">Financial</a></div>
                        </div> -->
                        <h1>{{ $article->a_name }}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                        <!-- <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                            <a href="#" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                                <div class="title"><span>John Doe</span></div>
                            </a>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="date"><i class="icon-clock"></i> 2 months ago</div>
                                <div class="views"><i class="icon-eye"></i> 500</div>
                                <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                            </div>
                        </div> -->
                        <div class="post-body">
                            <p class="lead">{{ $article->a_description }}</p>
                            {!! $article->a_content !!}
                        </div>
                        <div class="post-tags"><a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a><a href="#" class="tag">#Economy</a></div>
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                            @if($articlePrev)
                            <a href="{{ route('get.article_detail', ['slug' => $articlePrev->a_slug]) }}" class="prev-post text-left d-flex align-items-center">
                                <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                                <div class="text">
                                    <strong class="text-primary">Bài viết trước </strong>
                                    <h6 class="row-2">{{ $articlePrev->a_name }}</h6>
                                </div>
                            </a>
                            @endif
                            @if($articleNext)
                            <a href="{{ route('get.article_detail', ['slug' => $articleNext->a_slug]) }}" class="next-post text-right d-flex align-items-center justify-content-end">
                                <div class="text">
                                    <strong class="text-primary">Bài viết tiếp theo </strong>
                                    <h6 class="row-2">{{ $articleNext->a_name }}</h6>
                                </div>
                                <div class="icon next"><i class="fa fa-angle-right">   </i></div>
                            </a>
                            @endif
                        </div>
                        <!-- <div class="post-comments">
                            <header>
                                <h3 class="h6">Post Comments<span class="no-of-comments">(3)</span></h3>
                            </header>
                            <div class="comment">
                                <div class="comment-header d-flex justify-content-between">
                                    <div class="user d-flex align-items-center">
                                        <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="title"><strong>Jabi Hernandiz</strong><span class="date">May 2016</span></div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="add-comment">
                            <header>
                                <h3 class="h6">Để lại bình luận của bạn</h3>
                            </header>
                            <form action="#" class="commenting-form">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="username" id="username" placeholder="Name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" name="username" id="useremail" placeholder="Email Address (will not be published)" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="usercomment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-secondary">Submit Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
            </div>
        </main>
        @include('frontend.components._inc_sidebar_blog')
    </div>
</div>
@stop