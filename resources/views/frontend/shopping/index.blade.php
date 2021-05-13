@extends('layouts.app_frontend')
@section('title', 'Giỏ hàng của bạn')
@section('content')
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center" style="margin-top: 60px;">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Giỏ hàng</h1>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                                <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <h2 class="h5 text-uppercase mb-4">Danh sách sản phẩm</h2>
            @if($message ?? '')
                <h5 class="text-uppercase text-danger">{{ $message }}</h5>
            @endif
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        <table class="table">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Sản phẩm</strong></th>
                                    <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Giá</strong></th>
                                    <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Số lượng</strong></th>
                                    <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Tổng</strong></th>
                                    <th class="border-0" scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $row => $item)
                                <tr>
                                    <th class="pl-0 border-0" scope="row">
                                        <div class="media align-items-center">
                                            <a class="reset-anchor d-block animsition-link" href="#"><img src="{{ pare_url_file($item->options->image) }}" alt="..." height="70" width="70"></a>
                                            <div class="media-body ml-3">
                                                <strong class="h6"><a class="reset-anchor animsition-link" href="#">{{ $item->name }}</a></strong>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="align-middle border-0">
                                        @if($item->options->sale)
                                            <p class="mb-0 small">{{ number_format($item->price) }} VNĐ</p>
                                            <p class="mb-0 small"><del>{{ number_format($item->options->price_old) }}</del> VNĐ - {{$item->options->sale}}%</p>
                                        @else
                                            <p class="mb-0 small">{{ number_format($item->price) }} VNĐ</p>
                                        @endif
                                    </td>
                                    <td class="align-middle border-0">
                                        <div class="border d-flex align-items-center justify-content-between px-3">
                                            <span class="small text-uppercase text-gray headings-font-family">QTY</span>
                                            <div class="quantity">
                                                <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                                <input class="form-control form-control-sm border-0 shadow-0 p-0 val-qty" type="text" value="{{ $item->qty }}">
                                                <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle border-0">  
                                        <p class="mb-0 small">{{ number_format($item->price * $item->qty) }} VNĐ</p>
                                    </td>
                                    <td class="align-middle border-0">
                                        <a class="reset-anchor js-update-cart" href="{{ route('get_ajax.shopping.update', $row) }}"><i class="fas fa-pen small text-muted"></i></a>
                                        <a class="reset-anchor js-delete-cart" href="{{ route('get_ajax.shopping.delete', $row) }}"><i class="fas fa-trash-alt small text-muted"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-left">
                                <a class="btn btn-link p-0 text-dark btn-sm" href="{{ route('get.home') }}"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Tiếp tục mua hàng</a>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('get.shopping.checkout') }}">Thanh toán<i class="fas fa-long-arrow-alt-right ml-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ORDER TOTAL-->
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Thành tiền</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between">
                                    <strong class="text-uppercase small font-weight-bold">Tổng tiền thanh toán</strong>
                                    <span class="text-muted small">{{ Cart::subtotal(0) }} VNĐ</span>
                                </li>
                                <!-- <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>$250</span></li> -->
                                <!-- <li>
                                    <form action="#">
                                        <div class="form-group mb-0">
                                            <input class="form-control" type="text" placeholder="Enter your coupon">
                                            <button class="btn btn-dark btn-sm btn-block" type="submit"> <i class="fas fa-gift mr-2"></i>Apply coupon</button>
                                        </div>
                                    </form>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop