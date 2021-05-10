@extends('layouts.app_frontend')
@section('title', $title)
@section('content')

    <style>
        .sidebar-content .active
        {
            color: #b68b23;
        }
    </style>

    <div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; z-index: 9999; right: 50px; top: 60px; left: 55%; margin-top:15px;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; right: 50px; top: 60px; left: 60%; margin-top:15px;">
            <strong>Thất bại!</strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <!-- HERO SECTION-->
    <section class="py-5 bg-light" style="padding-top: 120px !important;">
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
                    <h6 class="text-uppercase mb-4">Tìm kiếm</h6>
                    <div>
                        <form action="">
                            <input type="text" name="k" value="{{ Request::get('k') }}" class="form-control" placeholder="Tìm kiếm...">
                            <button type="submit" class="btn btn-dark btn-sm d-block mt-2 mb-4 w-100">Tìm kiếm</button>
                        </form>
                    </div>
                    <aside class="sidebar-content">
                        <h6 class="text-uppercase mb-4">Khoảng giá</h6>
                        <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                            <li><a class="reset-anchor {{ Request::get('price') == 1 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 1]) }}">-- Nhỏ hơn &nbsp; 1.000.000 đ</a></li>
                            <li><a class="reset-anchor {{ Request::get('price') == 2 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 2]) }}">-- 1.000.000 - 5.000.000 đ</a></li>
                            <li><a class="reset-anchor {{ Request::get('price') == 3 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 3]) }}">-- 5.000.000 - 10.000.000 đ</a></li>
                            <li><a class="reset-anchor {{ Request::get('price') == 4 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 4]) }}">-- 10.000.000 - 15.000.000 đ</a></li>
                            <li><a class="reset-anchor {{ Request::get('price') == 5 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => 5]) }}">-- Lớn hơn &nbsp; 15.000.000 đ</a></li>
                        </ul>
                    </aside>
                    <h6 class="text-uppercase mb-4">Danh mục</h6>
                    @foreach($categoriesSort as $items)
                    <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">{{ $items->c_name }}</strong></div>
                        @if(isset($items->childs) && !$items->childs->isEmpty())
                            <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                                @foreach($items->childs as $item)
                                <li class="mb-2"><a class="reset-anchor" href="{{ route('get.category', ['slug' => $item->c_slug]) }}">--  {{ $item->c_name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach

                    <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Hãng sản suất</strong></div>
                        <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                            @foreach($manufacturers as $item)
                            <li class="mb-2"><a class="reset-anchor" href="{{ request()->fullUrlWithQuery(['m' => $item->id]) }}">--  {{ $item->m_name }}</a></li>
                            @endforeach
                        </ul>
                    
                </div>
                <!-- SHOP LISTING-->
                <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="row mb-3 align-items-center">
                        <div class="col-lg-6 mb-2 mb-lg-0">
                            <p class="text-small text-muted mb-0">Hiển thị {{ $products->currentPage() }}–{{ $products->perPage() }} của {{ $products->total() }} kết quả</p>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                                <label>Sắp xếp: &nbsp;</label>
                                <li class="list-inline-item">
                                    <form class="tree-most" id="form_order" method="get">
                                        <div class="dropdown bootstrap-select ml-auto" style="width: 200px;">
                                            <select class="selectpicker ml-auto" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Mặc định" tabindex="-98">
                                                <option {{ Request::get('sorting') == "default" ? "selected = 'selected'" : "" }} value="default">Mặc định</option>
                                                <option {{ Request::get('sorting') == "desc" ? "selected = 'selected'" : "" }} value="desc">Mới nhất</option>
                                                <option {{ Request::get('sorting') == "low-high" ? "selected = 'selected'" : "" }} value="low-high">Giá tăng dần</option>
                                                <option {{ Request::get('sorting') == "high-low" ? "selected = 'selected'" : "" }} value="high-low">Giá giảm dần</option>
                                            </select>
                                        </div>
                                    </form>
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
                                    <div class="badge text-white badge-" style="right: 68px;">
                                        @if($item->pro_sale)
                                            <span style="position: absolute; background-image: linear-gradient(-90deg, #ec1f1f 0%, #ff9c00 100%); border-radius: 10px; padding: 1px 7px; font-size: 13px;">Giảm {{ $item->pro_sale }}%</span>
                                        @endif
                                    </div>   
                                    <a class="d-block" href="{{ route('get.product_detail', ['slug' => $item->pro_slug]) }}">
                                        <img class="img-fluid w-100" src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->pro_name }}">
                                        </a>
                                    <div class="product-overlay">
                                        <ul class="mb-0 list-inline">
                                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="{{ route('get_user.wishlist.add', $item->id) }}"><i class="far fa-heart"></i></a></li>
                                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark js-add-cart" href="{{ route('get_ajax.shopping.add', $item->id) }}">Thêm giỏ hàng</a></li>
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
                    <div class="float-right">
                        {!! $products->appends($query ?? [])->links('vendor.pagination.bootstrap-4') !!}
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