@extends('layouts.app_frontend')
@section('title', 'Thanh toán')
@section('content')
    <div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Thanh toán</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('get.shopping') }}">Giỏ hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <!-- BILLING ADDRESS-->
        <h2 class="h5 text-uppercase mb-4">Thông tin thanh toán</h2>
        <div class="row">
            <div class="col-lg-8">
                <form action="#" method="POST"> 
                @csrf
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="firstName">Họ và tên</label>
                            <input class="form-control form-control-lg" id="firstName" value="{{ $user->name ?? ''}}" name="t_name" required type="text" placeholder="Enter your first name">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="email">Email</label>
                            <input class="form-control form-control-lg" id="email" value="{{ $user->email ?? ''}}" name="t_email" required type="email" placeholder="e.g. Jason@example.com">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-small text-uppercase" for="phone">Số điện thoại</label>
                            <input class="form-control form-control-lg" id="phone" value="{{ $user->phone ?? ''}}" name="t_phone" required type="tel" placeholder="e.g. +02 245354745">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="text-small text-uppercase" for="address">Địa chỉ</label>
                            <input class="form-control form-control-lg" id="address" value="{{ $user->address ?? ''}}" name="t_address" required type="text" placeholder="House number and street name">
                        </div>
                        <div class="col-lg-12 form-group">
                            <button class="btn btn-dark" type="submit">Đặt hàng</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
                <div class="card border-0 rounded-0 p-lg-4 bg-light">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-4">Tổng đơn hàng</h5>
                        <ul class="list-unstyled mb-0">
                            <!-- <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">Red digital smartwatch</strong><span class="text-muted small">$250</span></li>
                            <li class="border-bottom my-2"></li>
                            <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">Gray Nike running shoes</strong><span class="text-muted small">$351</span></li>
                            <li class="border-bottom my-2"></li> -->
                            <li class="d-flex align-items-center justify-content-between">
                                <strong class="text-uppercase small font-weight-bold">Số tiền</strong><span>{{ Cart::subtotal(0) }} VNĐ</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop