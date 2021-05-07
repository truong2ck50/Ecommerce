@extends('layouts.app_frontend')
@section('title', 'Thay đổi mật khẩu')
@section('content')
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center" style="margin-top: 60px;">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Đổi mật khẩu</h1>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                                <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <h2 class="h5 text-uppercase mb-4">Thay đổi mật khẩu</h2>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" style="position: fixed; right: 210px; top: 60px; left: 48%; margin-top:240px;">
                    <strong>Thành công!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @elseif(session('danger'))
                <div class="alert alert-danger alert-dismissible" style="position: fixed;  right: 210px; top: 60px; left: 60%; margin-top: 240px;">
                    <strong>Thất bại!</strong> {{ session('danger') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1"><b>Mật khẩu mới:</b></label>                                
                                <input type="password" class="form-control" autofocus name="password" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if ($errors->first('password'))
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><b>Xác nhận lại mật khẩu mới:</b></label>                                
                                <input type="password" class="form-control" name="password_confirm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if ($errors->first('password_confirm'))
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_confirm') }}</small>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-dark">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


@stop