@extends('layouts.app_user')
@section('title', 'Đơn hàng của bạn')
@section('content')
    <h4 style="margin-bottom: 10px">ĐƠN HÀNG CỦA BẠN</h4>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%;">
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
            <th>Tên KH</th>
            <th>SĐT</th>
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
                <td><span class="text-danger">{{ number_format($item->t_total_money, 0, ',', '.') }} đ</span></td>
                <td><span class="text-{{ $item->getStatus($item->t_status)['class'] }}">{{ $item->getStatus($item->t_status)['name'] }}</span></td>
                <td>{{ $item->t_note }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('get_user.transaction.view', $item->id) }}" class="btn btn-outline-info">Xem đơn hàng</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop