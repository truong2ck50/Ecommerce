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
        <link rel="stylesheet" href="{{ asset('asset_blog/vendor/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="{{ asset('asset_blog/vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Custom icon font-->
        <link rel="stylesheet" href="{{ asset('asset_blog/css/fontastic.css') }}">
        <!-- Google fonts - Open Sans-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
        <!-- Fancybox-->
        <link rel="stylesheet" href="{{ asset('asset_blog/vendor/@fancyapps/fancybox/jquery.fancybox.min.css') }}">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{ asset('asset_blog/css/style.default.css') }}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{ asset('asset_blog/css/custom.css') }}">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}">
        <style>
            .row-2 {
                line-height: 1.3;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                margin-bottom: 10px;
            }
        </style> 
    </head>
    <body>
        <header class="header">
            <!-- Main Navbar-->
            <nav class="navbar navbar-expand-lg">
                <div class="search-area">
                    <div class="search-area-inner d-flex align-items-center justify-content-center">
                        <div class="close-btn"><i class="icon-close"></i></div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <form action="#">
                                    <div class="form-group">
                                        <input type="search" name="search" id="search" placeholder="What are you looking for?">
                                        <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <!-- Navbar Brand -->
                    <div class="navbar-header d-flex align-items-center justify-content-between">
                        <!-- Navbar Brand --><a href="/" class="navbar-brand">Blog Website</a>
                        <!-- Toggle Button-->
                        <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
                    </div>
                    <!-- Navbar Menu -->
                    <div id="navbarcollapse" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            @foreach($menusGlobal as $item)
                            <li class="nav-item"><a href="{{ route('get.menu', $item->mn_slug) }}" class="nav-link {{ Request::segment(2) == $item->mn_slug ? 'active' : ''}}">{{$item->mn_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        <!-- Page Footer-->
        <footer class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="logo">
                            <h6 class="text-white">Blog Website</h6>
                        </div>
                        <div class="contact-details">
                            <p>Số 78, đường Quốc lộ 3, thôn Phù Mã, X. Phù Linh, H. Sóc Sơn, TP. Hà Nội</p>
                            <p>Phone: 0971459902</p>
                            <p>Email: <a href="mailto:truong2ck50@gmail.com">truong2ck50@gmail.com</a></p>
                            <ul class="social-menu">
                                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h6>Về chúng tôi</h6>
                        <div class="menus d-flex">
                            <ul class="list-unstyled">
                                <li> <a href="#">Tài khoản</a></li>
                                <li> <a href="#">Điều khoản sử dụng</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li> <a href="{{ route('get.home') }}">Trang chủ</a></li>
                                <li> <a href="{{ route('get.contact') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="latest-posts">
                            <!-- <a href="#">
                                <div class="post d-flex align-items-center">
                                    <div class="image"><img src="img/small-thumbnail-1.jpg" alt="..." class="img-fluid"></div>
                                    <div class="title"><strong>Hotels for all budgets</strong><span class="date last-meta">October 26, 2016</span></div>
                                </div>
                            </a>
                            <a href="#">
                                <div class="post d-flex align-items-center">
                                    <div class="image"><img src="img/small-thumbnail-2.jpg" alt="..." class="img-fluid"></div>
                                    <div class="title"><strong>Great street atrs in London</strong><span class="date last-meta">October 26, 2016</span></div>
                                </div>
                            </a>
                            <a href="#">
                                <div class="post d-flex align-items-center">
                                    <div class="image"><img src="img/small-thumbnail-3.jpg" alt="..." class="img-fluid"></div>
                                    <div class="title"><strong>Best coffee shops in Sydney</strong><span class="date last-meta">October 26, 2016</span></div>
                                </div>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyrights">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; 2021. All rights reserved. Your great site.</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p>
                                Template By <a href="https://bootstrapious.com/p/bootstrap-carousel" class="text-white">TruongNM</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- JavaScript files-->
        <script src="{{ asset('asset_blog/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('asset_blog/vendor/popper.js/umd/popper.min.js')}}"> </script>
        <script src="{{ asset('asset_blog/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('asset_blog/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
        <script src="{{ asset('asset_blog/vendor/@fancyapps/fancybox/jquery.fancybox.min.js')}}"></script>
        <script src="{{ asset('asset_blog/js/front.js')}}"></script>
    </body>
</html>