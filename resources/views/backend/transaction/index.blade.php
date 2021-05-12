@extends('layouts.app_backend')
@section('title', 'Danh sách đơn hàng')
@section('content')
    <h1>Quản lý đơn hàng</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%;">
            <strong>Thất bại!</strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form class="form-inline mb-2">
            <button type ="submit" name="export" value="true" class="btn btn-success">Export excel</button>
    </form>

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
                    <a href="{{ route('get_backend.transaction.view', $item->id) }}" class="btn btn-xs btn-primary">View</a>
                    <a href="{{ route('get_backend.transaction.delete', $item->id) }}" class="btn btn-xs btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop