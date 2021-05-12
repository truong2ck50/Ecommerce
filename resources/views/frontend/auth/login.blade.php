<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}">
    <style>
        .login,
        .image {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('https://res.cloudinary.com/mhmd/image/upload/v1555917661/art-colorful-contemporary-2047905_dxtao7.jpg');
            background-size: cover;
            background-position: center center;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-5 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-7 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" style="position: fixed; right: 210px; top: 60px; left: 55%;">
                                    <strong>Thành công!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            @elseif(session('danger'))
                                <div class="alert alert-danger alert-dismissible" style="position: fixed;  right: 210px; top: 60px; left: 60%;">
                                    <strong>Thất bại!</strong> {{ session('danger') }}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            @endif
                            <h3 class="display-5">Thành viên đăng nhập</h3>
                            <p class="text-muted mb-4">Điền đầy đủ thông tin đăng nhập hệ thống</p>
                            <form method="POST" action="">
                                @csrf                                
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="email" placeholder="Email address" name="email" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputPassword" type="password" placeholder="Password" name="password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Nhớ mật khẩu</label>                                    
                                </div>
                                <p class="lost_password" style="right: 0px;">
                                    <i><a href="{{ route('get.password-retrieval') }}" target="_blank">Quên mật khẩu?</a></i><br>
                                    <i><a href="{{ route('get.login.social', ['social' => 'google']) }}">Đăng nhập bằng Google</a></i>
                                </p>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Đăng nhập</button>
                                <div class="text-center d-flex justify-content-between mt-4"><p>Bạn chưa có tài khoản vui lòng đăng ký
                                        <a href="{{ route('get.register')}}" class="font-italic text-muted">
                                            <u>Tại đây</u></a></p></div>
                            </form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>

</body>
</html>
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
