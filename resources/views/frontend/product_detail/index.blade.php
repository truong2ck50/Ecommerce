@extends('layouts.app_frontend')
@section('title', $product->pro_name)
@section('content')
    <section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <!-- PRODUCT SLIDER-->
                <div class="row m-sm-0">
                    <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                        <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                            <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0 active"><img class="w-100" src="{{asset('img/product-detail-1.jpg')}}" alt="..."></div>
                            <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="{{asset('img/product-detail-2.jpg')}}" alt="..."></div>
                            <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="{{asset('img/product-detail-3.jpg')}}" alt="..."></div>
                            <div class="owl-thumb-item flex-fill mb-2"><img class="w-100" src="{{asset('img/product-detail-4.jpg')}}" alt="..."></div>
                        </div>
                    </div>
                    <div class="col-sm-10 order-1 order-sm-2">
                        <div class="owl-carousel product-slider owl-loaded owl-drag" data-slider-id="1">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1680px;">
                                    <div class="owl-item active" style="width: 420px;"><a class="d-block" href="{{asset('img/product-detail-1.jpg')}}" data-lightbox="product" title="Product item 1"><img class="img-fluid" src="{{asset('img/product-detail-1.jpg')}}" alt="..."></a></div>
                                    <div class="owl-item" style="width: 420px;"><a class="d-block" href="{{asset('img/product-detail-2.jpg')}}" data-lightbox="product" title="Product item 2"><img class="img-fluid" src="{{asset('img/product-detail-2.jpg')}}" alt="..."></a></div>
                                    <div class="owl-item" style="width: 420px;"><a class="d-block" href="{{asset('img/product-detail-3.jpg')}}" data-lightbox="product" title="Product item 3"><img class="img-fluid" src="{{asset('img/product-detail-3.jpg')}}" alt="..."></a></div>
                                    <div class="owl-item" style="width: 420px;"><a class="d-block" href="{{asset('img/product-detail-4.jpg')}}" data-lightbox="product" title="Product item 4"><img class="img-fluid" src="{{asset('img/product-detail-4.jpg')}}" alt="..."></a></div>
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
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    </ul>
                    <h1>{{ $product->pro_name }}</h1>
                    <p class="text-muted lead">{{ number_format($product->pro_price, 0, ',', '.') }} VNĐ</p>
                    <p class="text-small mb-4">{{ $product->pro_description }}</p>
                    <div class="row align-items-stretch mb-4 box-qty">
                        <div class="col-sm-5 pr-sm-0">
                            <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                <span class="small text-uppercase text-gray mr-4 no-select">Qty</span>
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
                    <a class="btn btn-link text-dark p-0 mb-4" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a><br>
                    <ul class="list-unstyled small d-inline-block">
                        <!-- <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">SKU:</strong><span class="ml-2 text-muted">039</span></li> -->
                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                            <strong class="text-uppercase text-dark">Danh mục:</strong>
                            <a class="reset-anchor ml-2" href="{{ route('get.category', ['slug' => $product->category->c_slug ?? '']) }}">{{ $product->category->c_name ?? [N\A] }}</a>
                        </li>
                        @if($product->keywords && !$product->keywords->isEmpty())
                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                            <strong class="text-uppercase text-dark">Từ khoá:</strong>
                            @foreach($product->keywords as $keyword)
                            <a class="reset-anchor ml-2" href="{{ route('get.keyword', ['slug' => $keyword->k_slug]) }}" title="{{ $keyword->k_name }}">{{ $keyword->k_name }}</a>
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
                                <div class="media mb-3">
                                    <img class="rounded-circle" src="img/customer-1.png" alt="" width="50">
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                        <ul class="list-inline mb-1 text-xs">
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                        <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <img class="rounded-circle" src="img/customer-2.png" alt="" width="50">
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                        <ul class="list-inline mb-1 text-xs">
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                        <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
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
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark " href="#">Thêm giỏ hàng</a></li>
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