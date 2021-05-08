@extends('layouts.app_backend')
@section('title', 'Danh sách đánh giá')
@section('content')
    <h1>Danh sách đánh giá</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-7">
            <div class="card">
                <div class="p-3">
                    <table class="table table-hover" id="jsDataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên KH</th>
                            <th>Sản phẩm</th>
                            <th>Nội dung</th>
                            <th>Đánh giá</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($votes as $item)    
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td><a href="{{ route('get.product_detail', $item->product->pro_slug) }}" target="_blank">{{ $item->product->pro_name }}</a></td>
                                <td style="width: 250px">{{ $item->v_content }}</td>
                                <td>{{ $item->v_number }}</td>
                                <td>
                                    <a href="{{ route('get_backend.vote.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card">
 
            </div>
        </div>
    </div>
@stop