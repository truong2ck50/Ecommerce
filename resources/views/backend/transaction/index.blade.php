@extends('layouts.app_backend')
@section('title', 'Danh sách đơn hàng')
@section('content')
    <h1>Danh sách đơn hàng</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%;">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <table class="table table-hover" id="jsDataTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên KH</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Tổng</th>
            <th>Trạng thái</th>
            <th>Ghi chú</th>
            <th>Thời gian</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $item)    
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->t_name }}</td>
                <td>{{ $item->t_phone }}</td>
                <td style="width: 300px;">{{ $item->t_address}}</td>
                <td><span class="text-danger">{{ number_format($item->t_total_money, 0, ',', '.') }} đ</span></td>
                <td><span class="text-{{ $item->getStatus($item->t_status)['class'] }}">{{ $item->getStatus($item->t_status)['name'] }}</span></td>
                <td>{{ $item->t_note }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ route('get_backend.transaction.view', $item->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('get_backend.transaction.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop