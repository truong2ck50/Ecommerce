@extends('layouts.app_user')
@section('title', 'Sản phẩm yêu thích')
@section('content')
    <h4 style="margin-bottom: 10px">DANH SÁCH SẢN PHẨM YÊU THÍCH CỦA BẠN</h4>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%; margin-top:35px;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%; margin-top: 45px;">
            <strong>Thất bại!</strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <table class="table table-hover" id="jsDataTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($wishLists as $item)    
            <tr>
                <td>{{ $item->id }}</td>
        <td style="width: 300px" class="text-danger">
                    <a href="{{ route('get.product_detail', $item->product->pro_slug) }}" target="_blank">
                        {{ $item->product->pro_name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('get.product_detail', $item->product->pro_slug) }}">
                        <img src="{{ pare_url_file($item->product->pro_avatar) ?? '' }}" class="img-thumbnail" style="width: 80px; height: 80px;" alt="">
                    </a>
                </td>
                <td><span>{{ number_format($item->product->pro_price, 0, ',', '.') }} đ</span></td>
                <td>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="{{ route('get_user.wishlist.delete', $item->id) }}" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop