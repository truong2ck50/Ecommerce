<section class="py-5">
    <header>
        <!-- <p class="small text-muted small text-uppercase mb-1">Made the hard way</p> -->
        <h2 class="h5 text-uppercase mb-4">Sản phẩm mới</h2>
    </header>
    <div class="row">
        <!-- PRODUCT-->
        @foreach($products as $key => $item)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="product text-center">                
                <div class="position-relative mb-3">
                    <div class="badge text-white badge-" style="right: 68px;">
                    @if($item->pro_sale)
                        <span style="position: absolute; background-image: linear-gradient(-90deg, #ec1f1f 0%, #ff9c00 100%); border-radius: 10px; padding: 1px 7px; font-size: 13px;">Giảm {{ $item->pro_sale }}%</span>
                    @endif
                    </div>
                    <a class="d-block" href="{{ route('get.product_detail', ['slug' => $item->pro_slug]) }}" title="{{ $item->pro_name }}">
                        <img class="img-fluid w-100" src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->pro_name }}">
                    </a>
                    <div class="product-overlay">
                        <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0">
                                <a class="btn btn-sm btn-outline-dark" href="{{ route('get_user.wishlist.add', $item->id) }}"><i class="far fa-heart"></i></a>
                            </li>
                            <li class="list-inline-item m-0 p-0">
                                <a class="btn btn-sm btn-dark js-add-cart" href="{{ route('get_ajax.shopping.add', $item->id) }}">Thêm giỏ hàng</a>
                            </li>
                            <li class="list-inline-item mr-0">
                                <a class="btn btn-sm btn-outline-dark js-product-preview" href="{{ route('get_ajax.product_preview', $item->id) }}" data-toggle="modal"><i class="fas fa-expand"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <h6> 
                    <a class="reset-anchor" title="{{ $item->pro_name }}" href="{{ route('get.product_detail', ['slug' => $item->pro_slug]) }}">{{ $item->pro_name }}</a>
                </h6>
                <p class="small text-muted">    {{ number_format($item->pro_price, 0, ',', '.') }} VNĐ</p>
            </div>
        </div>
        @if($key == 5)
            <div class="col-xl-6 col-lg-4 col-sm-6">
                <div class="product text-center">
                    <a href="">
                        <img src="images/samsung-galaxy-tab-a7-2020-ft.jpg" alt="">
                    </a>
                </div>
            </div>
        @endif
        @endforeach
    </div>
</section>
