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
            <th>Thông tin</th>
            <th>Tổng</th>
            <th>Trạng thái</th>
            <th>Phương thức</th>
            <th>Ghi chú</th>
            <th>Thời gian</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $item)    
            <tr>
                <td>{{ $item->id }}</td>
                <td style="width: 350px;">
                    <ul>
                        <li>Tên KH: {{ $item->t_name }} </li>
                        <li>Email: {{ $item->t_email}} </li>
                        <li>SĐT: {{ $item->t_phone}} </li>
                        <li>Địa chỉ: {{ $item->t_address}} </li>
                    </ul>
                </td>
                
                <td><span class="text-danger">{{ number_format($item->t_total_money, 0, ',', '.') }} đ</span></td>
                <td><span class="text-{{ $item->getStatus($item->t_status)['class'] }}">{{ $item->getStatus($item->t_status)['name'] }}</span></td>
                <td>
                    @if($item->payment)
                        <ul>
                            <li>Ngân hàng: {{ $item->payment->p_code_bank }}</li>
                            <li>Mã GD: {{ $item->payment->p_code_vnpay }}</li>
                            <li>Tổng tiền: {{ number_format($item->payment->p_money, 0, ',','.') }} VNĐ</li>
                            <li>Nội dung: {{ $item->payment->p_note }}</li>
                            <li>Thời gian: {{ date('Y-m-d H:i:s', strtotime($item->payment->p_time)) }}</li>
                        </ul>
                    @else
                        Thanh toán khi nhận hàng
                    @endif
                </td>
                <td style="width: 200px;">{{ $item->t_note }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                <td style="width: 200px;">
                    <a href="{{ route('get_backend.transaction.invoice', $item->id) }}" class="btn btn-sm btn-info" target="_blank">Export</a>
                    <a href="{{ route('get_backend.transaction.view', $item->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="{{ route('get_backend.transaction.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop