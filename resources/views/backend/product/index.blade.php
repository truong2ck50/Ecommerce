@extends('layouts.app_backend')
@section('title', 'Danh sách sản phẩm')
@section('content')
    <h1>Danh sách sản phẩm <a href="{{ route('get_backend.product.create') }}" class="btn btn-xs btn-success">Thêm mới</a></h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Price</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $item)    
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <a href="">
                        <img src="{{ pare_url_file($item->pro_avatar) }}" class="img-thumbnail" style="width: 60px; height: 60px;" alt="">
                    </a>
                </td>
                <td>{{ $item->pro_name }}</td>
                <td>{{ $item->pro_slug }}</td>
                <td><span class="text-danger">{{ number_format($item->pro_price, 0, ',', '.') }} đ</span></td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ route('get_backend.product.update', $item->id) }}" class="btn btn-xs btn-primary">Update</a>
                    <a href="{{ route('get_backend.product.delete', $item->id) }}" class="btn btn-xs btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop