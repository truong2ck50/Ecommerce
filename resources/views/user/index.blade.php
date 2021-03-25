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

            .vertical-nav {
            min-width: 17rem;
            width: 17rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.4s;
            }

            .page-content {
            width: calc(100% - 17rem);
            margin-left: 17rem;
            transition: all 0.4s;
            }

            /* for toggle behavior */

            #sidebar.active {
            margin-left: -17rem;
            }

            #content.active {
            width: 100%;
            margin: 0;
            }

            @media (max-width: 768px) {
                #sidebar {
                    margin-left: -17rem;
                }
                #sidebar.active {
                    margin-left: 0;
                }
                #content {
                    width: 100%;
                    margin: 0;
                }
                #content.active {
                    margin-left: 17rem;
                    width: calc(100% - 17rem);
                }
            }

            /*
            *
            * ==========================================
            * FOR DEMO PURPOSE
            * ==========================================
            *
            */

            body {
            background: #599fd9;
            background: -webkit-linear-gradient(to right, #599fd9, #c2e59c);
            background: linear-gradient(to right, #599fd9, #c2e59c);
            min-height: 100vh;
            overflow-x: hidden;
            }

            .separator {
            margin: 3rem 0;
            border-bottom: 1px dashed #fff;
            }

            .text-uppercase {
            letter-spacing: 0.1em;
            }

            .text-gray {
            color: #aaa;
            }
        </style> 
    </head>
    <body>  
        <!-- Vertical navbar -->
        <div class="vertical-nav bg-white" id="sidebar">
            <div class="py-4 px-3 mb-4 bg-light">
                <div class="media d-flex align-items-center">
                    <img src="https://res.cloudinary.com/mhmd/image/upload/v1556074849/avatar-1_tcnd60.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                    <div class="media-body">
                        <h4 class="m-0">Jason Doe</h4>
                        <p class="font-weight-light text-muted mb-0">Web developer</p>
                    </div>
                </div>
            </div>
            <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>
            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                    About
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                    Services
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                    Gallery
                    </a>
                </li>
            </ul>
            <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Charts</p>
            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                    Area charts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                    Bar charts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-pie-chart mr-3 text-primary fa-fw"></i>
                    Pie charts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-line-chart mr-3 text-primary fa-fw"></i>
                    Line charts
                    </a>
                </li>
            </ul>
        </div>
        <!-- End vertical navbar -->
        <!-- Page content holder -->
        <div class="page-content p-5" id="content">
            <!-- Toggle button -->
            <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
            <!-- Demo content -->
            <h2 class="display-4 text-white">Bootstrap vertical nav</h2>
            <p class="lead text-white mb-0">Build a fixed sidebar using Bootstrap 4 vertical navigation and media objects.</p>
            <p class="lead text-white">Snippet by <a href="https://bootstrapious.com/snippets" class="text-white">
                <u>Bootstrapious</u></a>
            </p>
            <div class="separator"></div>
            <div class="row text-white">
                <div class="col-lg-7">
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor.
                    </p>
                    <div class="bg-white p-5 rounded my-5 shadow-sm">
                        <p class="lead font-italic mb-0 text-muted">"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                        </p>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor.
                    </p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor.
                    </p>
                </div>
                <div class="col-lg-5">
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor.
                    </p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor.
                    </p>
                </div>
            </div>
        </div>
        <!-- End demo content -->
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
                                <li> <a href="#">Trang chủ</a></li>
                                <li> <a href="#">Liên hệ</a></li>
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