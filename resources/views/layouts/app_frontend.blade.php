<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
        <!-- Lightbox-->
        <link rel="stylesheet" href="{{ asset('vendor/lightbox2/css/lightbox.min.css')}}">
        <!-- Range slider-->
        <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.min.css')}}">
        <!-- Bootstrap select-->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/css/bootstrap-select.min.css')}}">
        <!-- Owl Carousel-->
        <link rel="stylesheet" href="{{ asset('vendor/owl.carousel2/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset('vendor/owl.carousel2/assets/owl.theme.default.css')}}">
        <!-- Google fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{ asset('css/style.default.css')}}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}">
    </head>
    <body>
        <div class="page-holder">
            <!-- navbar-->
            <header class="header bg-white" style="position: fixed; width: 100%; top: 0; z-index: 99;">
                <div class="container px-0 px-lg-3">
                    <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0">
                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" title="Trang chủ" href="{{ route('get.home') }}" ><i class="fas fa-home"></i>Trang chủ</a>
                                </li>
                                @foreach($categoriesGlobal as $item)
                                    @php
                                        $flagSubMenu = (isset($item->childs) && !$item->childs->isEmpty()) ? true : false;
                                    @endphp
                                    <li class="{{ $flagSubMenu ? 'dropdown' : '' }}">
                                        <a class="nav-link {{ $flagSubMenu ? 'dropdown-toggle' : '' }}" data-toggle="{{ $flagSubMenu ? 'dropdown' : '' }}" role="button" aria-haspopup="true" aria-expanded="true" 
                                        title="{{ $item->c_name }}" 
                                        href="{{ route('get.category', $item->c_slug)}}">{{ $item->c_name }}</a>
                                    @if(isset($item->childs) && !$item->childs->isEmpty())
                                        <ul class="dropdown-menu">
                                            @foreach($item->childs as $item)
                                                <li><a href="{{ route('get.category', $item->c_slug)}}">{{ $item->c_name }}</a></li>                                                
                                            @endforeach
                                        </ul>
                                    @endif
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link" title="Bài viết" href="{{ route('get.blog') }}">Bài viết</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('get.shopping') }}" title="Giỏ hàng"> 
                                        <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>Giỏ hàng<small class="text-gray" id="totalCart">({{ Cart::count() }})</small>
                                    </a>
                                 </li>
                                <li class="nav-item"><a class="nav-link" href="#"> <i class="far fa-heart mr-1"></i><small class="text-gray"> (0)</small></a></li>
                                @if(get_data_user('web'))
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            {{ get_data_user('web', 'name') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('get_user.home') }}">Quản lý</a>
                                            <a class="dropdown-item" href="{{ route('get.logout') }}">Đăng xuất</a>
                                        </div>
                                    </div>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('get.login') }}"> <i class="fas fa-user-alt mr-1 text-gray"></i>Đăng nhập</a>
                                    </li>   
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <!--  Modal -->
            <div class="modal fade" id="productView" tabindex="-1" role="dialog" aria-hidden="true">
            </div>
            <!-- HERO SECTION-->
            @yield('content')
            <footer class="bg-dark text-white">
                <div class="container py-4">
                    <div class="row py-5">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <h6 class="text-uppercase mb-3">Thông tin liên hệ</h6>
                            <ul class="list-unstyled mb-0">
                                <li><a class="footer-link" href="#">Công ty TNHH Thiết bị kỹ thuật Tin học Trường Chinh</a></li>
                                <li><a class="footer-link" href="#">Trụ sở chính: Số 78, đường Quốc lộ 3, thôn Phù Mã, Xã Phù Linh, Huyện Sóc Sơn, TP Hà Nội</a></li>
                                <li><a class="footer-link" href="#">Email: truong2ck50@gmail.com</a></li>
                                <li><a class="footer-link" href="#">Phone: 0971459902</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <h6 class="text-uppercase mb-3">Về chúng tôi</h6>
                            <ul class="list-unstyled mb-0">
                                <li><a class="footer-link" href="{{ route('get.contact') }}">Liên hệ</a></li>
                                @foreach($menusGlobal as $item)
                                    <li><a class="footer-link" href="{{ route('get.menu', $item->mn_slug) }}">{{ $item->mn_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-uppercase mb-3">Chính sách</h6>
                            <ul class="list-unstyled mb-0">
                                <li><a class="footer-link" href="#">Chính sách mua hàng</a></li>
                                <li><a class="footer-link" href="#">Chính sách đổi trả</a></li>
                                <li><a class="footer-link" href="#">Chính sách bảo hành</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="border-top pt-4" style="border-color: #1d1d1d !important">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="small text-muted mb-0">&copy; 2021 All rights reserved.</p>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstraptemple.com/p/bootstrap-ecommerce">Bootstrap Temple</a></p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </footer>
            <!-- JavaScript files-->
            <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{ asset('vendor/lightbox2/js/lightbox.min.js')}}"></script>
            <script src="{{ asset('vendor/nouislider/nouislider.min.js')}}"></script>
            <script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
            <script src="{{ asset('vendor/owl.carousel2/owl.carousel.min.js')}}"></script>
            <script src="{{ asset('vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js')}}"></script>
            <script src="{{ asset('js/front.js')}}"></script>
            <script>
                // ------------------------------------------------------- //
                //   Inject SVG Sprite - 
                //   see more here 
                //   https://css-tricks.com/ajaxing-svg-sprite/
                // ------------------------------------------------------ //
                function injectSvgSprite(path) {
                
                    var ajax = new XMLHttpRequest();
                    ajax.open("GET", path, true);
                    ajax.send();
                    ajax.onload = function(e) {
                    var div = document.createElement("div");
                    div.className = 'd-none';
                    div.innerHTML = ajax.responseText;
                    document.body.insertBefore(div, document.body.childNodes[0]);
                    }
                }
                // this is set to BootstrapTemple website as you cannot 
                // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
                // while using file:// protocol
                // pls don't forget to change to your domain :)
                injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
                
            </script>
            <script>
                $(function(){
                    $(".js-product-preview").click(function(event){
                        event.preventDefault()
                        let $this = $(this)
                        let URL = $this.attr("href")
                        $.ajax({
                            url: URL,
                        }).done(function( results ) {
                            if(results.status === 200) 
                            {
                                $("#productView").html(results.html).modal({
                                    show: true
                                })
                            }
                            console.log(results)
                        });
                    })

                    $("body").on("click",'.js-add-cart', function(event){
                        event.preventDefault()
                        let $this = $(this)
                        let URL = $this.attr("href")
                        let qty = 1
                        let $elementQty = $this.parents('.box-qty').find('.val-qty')
                        if($elementQty.length)
                        {
                            qty = $elementQty.val()
                        }

                        $.ajax({
                            url: URL,
                            data: {
                                qty : qty
                            }
                        }).done(function( results ) {
                            alert(results.message)
                            if(typeof results.totalCart !== "undefined")
                                $("#totalCart").text("(" + results.totalCart + ")")
                        });
                    })

                    $("body").on("click",'.js-delete-cart', function(event){
                        event.preventDefault()
                        let $this = $(this)
                        let URL = $this.attr("href")

                        $.ajax({
                            url: URL
                        }).done(function( results ) {
                            alert(results.message)
                            if(results.status === 200)
                            {
                                $this.parents('tr').remove()

                                if(typeof results.totalCart !== "undefined")
                                    $("#totalCart").text("(" + results.totalCart + ")")
                            }
                        });
                    })

                    $("body").on("click",'.js-update-cart', function(event){
                        event.preventDefault()
                        let $this = $(this)
                        let URL = $this.attr("href")
                        let $elementQty = $this.parents('tr').find('.val-qty')
                        if($elementQty.length)
                        {
                            qty = $elementQty.val()
                        }
                        console.log(qty)
                        $.ajax({
                            url: URL,
                            data: {
                                qty : qty
                            }
                        }).done(function( results ) {
                            alert(results.message)
                            if(typeof results.totalCart !== "undefined")
                                $("#totalCart").text("(" + results.totalCart + ")")
                            location.reload()
                        });
                    })
                })
            </script>
            <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        </div>
    </body>
</html>