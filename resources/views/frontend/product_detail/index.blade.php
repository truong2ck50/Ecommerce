@extends('layouts.app_frontend')
@section('title', $product->pro_name)
@section('content')
    <section class="py-5">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" style="position: fixed; z-index: 9999; right: 50px; top: 60px; left: 60%; margin-top:15px;">
                <strong>Thành công!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @elseif(session('danger'))
            <div class="alert alert-danger alert-dismissible" style="position: fixed; z-index: 9999; right: 50px; top: 60px; left: 60%; margin-top:15px;">
                <strong>Thất bại!</strong> {{ session('danger') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        <div class="row mb-5">
            <div class="col-lg-6">
                <!-- PRODUCT SLIDER-->
                <div class="row m-sm-0">
                    <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                        <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                            <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0 active">
                                <img class="w-100" 
                                    style=" width: 100px; height: 100px;" 
                                    src="{{ pare_url_file($product->pro_avatar) }}" alt="...">
                            </div>
                            <!-- <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="{{asset('img/product-detail-2.jpg')}}" alt="..."></div>
                            <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="{{asset('img/product-detail-3.jpg')}}" alt="..."></div>
                            <div class="owl-thumb-item flex-fill mb-2"><img class="w-100" src="{{asset('img/product-detail-4.jpg')}}" alt="..."></div> -->
                        </div>
                    </div>
                    <div class="col-sm-10 order-1 order-sm-2">
                        <div class="owl-carousel product-slider owl-loaded owl-drag" data-slider-id="1">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1680px;">
                                    <div class="owl-item active" style="width: 420px;"><a class="d-block" href="{{ pare_url_file($product->pro_avatar) }}" data-lightbox="product" title="Product item 1">
                                        <img class="img-fluid" style="width:420px; height: 500px;" src="{{ pare_url_file($product->pro_avatar) }}" alt="..."></a>
                                    </div>
                                    <!-- <div class="owl-item" style="width: 420px;"><a class="d-block" href="{{asset('img/product-detail-2.jpg')}}" data-lightbox="product" title="Product item 2"><img class="img-fluid" src="{{asset('img/product-detail-2.jpg')}}" alt="..."></a></div>
                                    <div class="owl-item" style="width: 420px;"><a class="d-block" href="{{asset('img/product-detail-3.jpg')}}" data-lightbox="product" title="Product item 3"><img class="img-fluid" src="{{asset('img/product-detail-3.jpg')}}" alt="..."></a></div>
                                    <div class="owl-item" style="width: 420px;"><a class="d-block" href="{{asset('img/product-detail-4.jpg')}}" data-lightbox="product" title="Product item 4"><img class="img-fluid" src="{{asset('img/product-detail-4.jpg')}}" alt="..."></a></div> -->
                                </div>
                            </div>
                            <div class="owl-nav disabled">
                                <div class="owl-prev">prev</div>
                                <div class="owl-next">next</div>
                            </div>
                            <div class="owl-dots">
                                <div class="owl-dot active"><span></span></div>
                                <div class="owl-dot"><span></span></div>
                                <div class="owl-dot"><span></span></div>
                                <div class="owl-dot"><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6">
                    @php
                        $age = 0;
                        if($product->pro_review_total)
                        {
                            $age = round($product->pro_review_star / $product->pro_review_total, 0);
                        }
                    @endphp
                    <ul class="list-inline mb-2 mt-4">
                        @if($product->pro_review_total)
                            @for($i = 1; $i <= 5; $i++)
                                <li class="list-inline-item m-0">
                                    <i class="fas fa-star {{ $i <= $age ? '' : 'fa-star-half-alt' }} text-warning"></i>
                                </li>
                            @endfor
                        @else
                            <li class="list-inline-item m-0">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </li>
                        @endif
                    </ul>
                    <h1>{{ $product->pro_name }}</h1>
                    @if($product->pro_sale)
                        <p class="text-muted lead">{{ number_format((($product->pro_price * (100 - $product->pro_sale))/100), 0, ',', '.') }} VNĐ</p>
                        <p class="text-muted lead"><del>{{ number_format($product->pro_price, 0, ',', '.') }} VNĐ</del></p>
                    @else
                        <p class="text-muted lead">{{ number_format($product->pro_price, 0, ',', '.') }} VNĐ</p>
                    @endif
                    <p class="text-small mb-4">{{ $product->pro_description }}</p>
                    <div class="row align-items-stretch mb-4 box-qty">
                        <div class="col-sm-5 pr-sm-0">
                            <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                <span class="small text-uppercase text-gray mr-4 no-select">Số lượng</span>
                                <div class="quantity">
                                    <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                    <input class="form-control border-0 shadow-0 p-0 val-qty" type="text" value="1">
                                    <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pl-sm-0">
                            <a class="js-add-cart btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="{{ route('get_ajax.shopping.add', $product->id) }}">Thêm giỏ hàng</a>
                        </div>
                    </div>
                    <a class="btn btn-link text-dark p-0 mb-4" href="{{ route('get_user.wishlist.add', $product->id) }}"><i class="far fa-heart mr-2"></i>Thêm vào yêu thích</a><br>
                    <ul class="list-unstyled small d-inline-block">
                        <li class="px-3 py-2 mb-1 bg-white">
                            <strong class="text-uppercase">Số lượng sản phẩm:</strong>
                            <span class="ml-2 text-muted">
                                @if($product->pro_number == 0)
                                   Tạm hết hàng
                                @else    
                                    {{$product->pro_number}}
                                @endif
                            </span>
                        </li>
                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                            <strong class="text-uppercase text-dark">Danh mục:</strong>
                            <a class="reset-anchor ml-2" style="display: inline-flex;" href="{{ route('get.category', ['slug' => $product->category->c_slug ?? '']) }}">{{ $product->category->c_name ?? [N\A] }}</a>
                        </li>
                        @if($product->keywords && !$product->keywords->isEmpty())
                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                            <strong class="text-uppercase text-dark">Từ khoá:</strong>
                            @foreach($product->keywords as $keyword)
                            <a class="reset-anchor ml-2" style="display: inline-flex;" href="{{ route('get.keyword', ['slug' => $keyword->k_slug]) }}" title="{{ $keyword->k_name }}">{{ $keyword->k_name }}</a>
                            @endforeach
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- DETAILS TABS-->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Mô tả sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment" role="tab" aria-controls="reviews" aria-selected="false">Bình luận</a></li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        {!! $product->pro_content !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <div class="row">
                            <div class="col-lg-8">
                            @foreach($votes as $item)
                                <div class="media mb-3">
                                    <img class="rounded-circle" src="img/customer-1.png" alt="" width="50">
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0 text-uppercase">{{ $item->user->name ?? '[N\A]' }}</h6>
                                        <p class="small text-muted mb-0 text-uppercase">{{ $item->created_at }}</p>
                                        <ul class="list-inline mb-1 text-xs">
                                            @for($i = 1; $i <=5; $i++)
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star {{ $i <= $item->v_number ? '' : 'fa-star-half-alt' }} text-warning"></i>
                                                </li> 
                                            @endfor
                                        </ul>
                                        <p class="text-small mb-0 text-muted">{{ $item->v_content }}</p>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <div class="row">
                            <div class="col-lg-8">
                                <h4>Bình luận</h4>
                                <div class="post-comments">
                                    @foreach($comments as $item)
                                        <div class="comment" style="margin-bottom: 20px;">
                                            <div class="comment-header d-flex justify-content-between">
                                                <div class="user d-flex align-items-center">
                                                    <div class="image"><img style="width: 50px; margin-bottom: 5px;" src="{{ pare_url_file($item->user->avatar ?? '') }}" alt="..." class="img-fluid rounded-circle"></div>
                                                    <div class="title"><strong>{{ $item->c_name }}</strong><span class="date">{{' '.$item->created_at }}</span></div>
                                                </div>
                                            </div>
                                            <div class="comment-body">
                                                <p>{{ $item->c_content }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if(get_data_user('web'))
                                    <div class="add-comment">
                                        <header>
                                            <h3 class="h6">Để lại bình luận của bạn</h3>
                                        </header>
                                        <form action="{{ route('get.product_detail.comment', ['slug' => $product->pro_slug]) }}" method="POST" class="commenting-form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="username" value="{{get_data_user('web', 'name')}}" id="username" placeholder="Name" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="email" name="username" id="useremail" disabled placeholder="" value="{{get_data_user('web', 'email')}}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <textarea name="comment" id="usercomment" required placeholder="Type your comment" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-secondary">Gửi bình luận</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <a href="{{ route('get.login') }}" style="color: red;">Đăng nhập để bình luận</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- RELATED PRODUCTS-->
            <h2 class="h5 text-uppercase mb-4">Sản phẩm liên quan</h2>
            <div class="row">
                <!-- PRODUCT-->
                @foreach ($productsRelated as $item)
                <div class="col-lg-3 col-sm-6">
                    <div class="product text-center skel-loader">
                        <div class="d-block mb-3 position-relative">
                            <a class="d-block" href="{{ route('get.product_detail', ['slug' => $item->pro_slug]) }}">
                                <img class="img-fluid w-100" src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->pro_name }}">
                            </a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="{{ route('get_user.wishlist.add', $product->id) }}"><i class="far fa-heart"></i></a></li>
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark js-add-cart" href="{{ route('get_ajax.shopping.add', $product->id) }}   ">Thêm giỏ hàng</a></li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn btn-sm btn-outline-dark js-product-preview" href="{{ route('get_ajax.product_preview', $item->id) }}" data-toggle="modal"><i class="fas fa-expand"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h6> <a class="reset-anchor" title="{{ $item->pro_name }}" href="{{ route('get.product_detail', ['slug' => $item->pro_slug]) }}">{{ $item->pro_name }}</a></h6>
                        <p class="small text-muted">{{ number_format($item->pro_price, 0, ',', '.') }} VNĐ</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@stop