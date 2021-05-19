@extends('layouts.app_backend')
@section('title', 'Danh sách sản phẩm')
@section('content')
    <style>
        .table-responsive .active{
            color: red;
        }
    </style>

    <div class="table-responsive">
        <h1>Thống kê <a href="?type=inventory" class="{{ Request::get('type') == 'inventory' || !Request::get('type') ? 'active' : '' }}">Hàng tồn</a> - <a href="?type=pay" class="{{ Request::get('type') == 'pay' ? 'active' : '' }}" >Bán chạy</a> - <a href="?type=outOfStock" class="{{ Request::get('type') == 'outOfStock' ? 'active' : '' }}" >Hết hàng</a></h1>

        <!-- <table class="table table-hover" id="jsDataTable"> -->
        <div class="float-right">
            {!! $products->appends($query ?? [])->links('vendor.pagination.bootstrap-4') !!}
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Hot</th>
                <th>Số lượng</th>
                <th>Đã bán</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $item)    
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <a href="">
                            <img src="{{ pare_url_file($item->pro_avatar) }}" class="img-thumbnail" style="width: 80px; height: 80px;" alt="">
                        </a>
                    </td>
                    <td style="width: 300px">
                        <a href="{{ route('get.product_detail', $item->pro_slug) }}" target="_blank">
                            {{ $item->pro_name }}
                        </a>
                        <ul style="padding-left: 16px;">
                            <li>Giá:<span class="text-danger"><i class ="fas fa-dollar-sign"></i> {{ number_format($item->pro_price, 0, ',', '.') }} đ</span></li>
                            <li><span><i class ="fas fa-dollar-sign"></i>Khuyến mãi: {{ $item->pro_sale}}%</span></li>
                        </ul>
                    </td>
                    <td>{{ $item->category->c_name ?? '[N\A]' }}</td>
                    <td>
                        <a href="{{ route('get_backend.product.active', $item->id) }}" class="text-{{ $item->getStatus($item->pro_active)['class'] }}">{{ $item->getStatus($item->pro_active)['name'] }}</a>
                    </td>
                    <td>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline" value="1" {{$item->pro_hot == 1 ? "checked" : ""}} class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">Nổi bật</label>
                        </div>
                    </td>
                    <td style="padding-left: 40px;" ><b>{{ $item->pro_number }}</b></td>
                    <td style="padding-left: 40px;" ><b>{{ $item->pro_pay }}</b></td>
                    <td>
                        <a href="{{ route('get_backend.product.update', $item->id) }}" class="btn btn-sm btn-primary">Update</a>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"href="{{ route('get_backend.product.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop