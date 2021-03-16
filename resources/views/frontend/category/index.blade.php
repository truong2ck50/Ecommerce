@extends('layouts.app_frontend')
@section('title', $title)
@section('content')
    <div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Sản phẩm</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                            @if(isset($category))
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->c_name }}</li>
                            @endif
                            @if(isset($keyword))
                            <li class="breadcrumb-item active" aria-current="page">{{ $keyword->k_name }}</li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <!-- SHOP SIDEBAR-->
                <div class="col-lg-3 order-2 order-lg-1">
                    <h5 class="text-uppercase mb-4">Danh mục</h5>
                    @foreach($categoriesSort as $items)
                    <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">{{ $items->c_name }}</strong></div>
                        @if(isset($items->childs) && !$items->childs->isEmpty())
                            <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                                @foreach($items->childs as $item)
                                <li class="mb-2"><a class="reset-anchor" href="{{ route('get.category', ['slug' => $item->c_slug]) }}">{{ $item->c_name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                    <h6 class="text-uppercase mb-4">Khoảng giá</h6>
                    <div class="price-range pt-4 mb-5">
                        <div id="range" class="noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                            <div class="noUi-base">
                                <div class="noUi-connects">
                                    <div class="noUi-connect noUi-draggable" style="transform: translate(5%, 0px) scale(0.45, 1);"></div>
                                </div>
                                <div class="noUi-origin" style="transform: translate(-950%, 0px); z-index: 5;">
                                    <div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="700.0" aria-valuenow="100.0" aria-valuetext="$100">
                                        <div class="noUi-touch-area"></div>
                                        <div class="noUi-tooltip">$100</div>
                                    </div>
                                </div>
                                <div class="noUi-origin" style="transform: translate(-500%, 0px); z-index: 6;">
                                    <div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="400.0" aria-valuemax="2000.0" aria-valuenow="1000.0" aria-valuetext="$1000">
                                        <div class="noUi-touch-area"></div>
                                        <div class="noUi-tooltip">$1000</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-6"><strong class="small font-weight-bold text-uppercase">From</strong></div>
                            <div class="col-6 text-right"><strong class="small font-weight-bold text-uppercase">To</strong></div>
                        </div>
                    </div>
                </div>
                <!-- SHOP LISTING-->
                <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="row mb-3 align-items-center">
                        <div class="col-lg-6 mb-2 mb-lg-0">
                            <p class="text-small text-muted mb-0">Hiển thị {{ $products->currentPage() }}–{{ $products->perPage() }} của {{ $products->total() }} kết quả</p>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                                <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th-large"></i></a></li>
                                <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th"></i></a></li>
                                <li class="list-inline-item">
                                    <div class="dropdown bootstrap-select ml-auto" style="width: 200px;">
                                        <select class="selectpicker ml-auto" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Default sorting" tabindex="-98">
                                            <option class="bs-title-option" value=""></option>
                                            <option value="default">Default sorting</option>
                                            <option value="popularity">Popularity</option>
                                            <option value="low-high">Price: Low to High</option>
                                            <option value="high-low">Price: High to Low</option>
                                        </select>
                                        <button type="button" class="btn dropdown-toggle bs-select-form-control bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Default sorting">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">Default sorting</div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <!-- PRODUCT-->
                        @foreach($products as $item)
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="mb-3 position-relative">
                                    <div class="badge text-white badge-"></div>
                                    <a class="d-block" href="{{ route('get.product_detail', ['slug' => $item->pro_slug]) }}">
                                        <img class="img-fluid w-100" src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->pro_name }}">
                                        </a>
                                    <div class="product-overlay">
                                        <ul class="mb-0 list-inline">
                                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="">Thêm giỏ hàng</a></li>
                                            <li class="list-inline-item mr-0">
                                                <a class="btn btn-sm btn-outline-dark js-product-preview" href="{{ route('get_ajax.product_preview', $item->id) }}" data-toggle="modal"><i class="fas fa-expand"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <h6> <a class="reset-anchor" href="{{ route('get.product_detail', ['slug' => $item->pro_slug]) }}">{{ $item->pro_name }}</a></h6>
                                <p class="small text-muted">{{ number_format($item->pro_price, 0, ',', '.') }} VNĐ</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- PAGINATION-->
                    <!-- <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center justify-content-lg-end">
                            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>
    </section>
</div>
@stop