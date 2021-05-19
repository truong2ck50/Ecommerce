@extends('layouts.app_backend')
@section('title', 'Chi tiết đơn hàng')
@section('content')
    <h1>Chi tiết đơn hàng {{ $transaction->id }} - Tổng tiền <b class="text-danger">{{ number_format($transaction->t_total_money, 0, ',', '.') }} VNĐ</b></h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 65%;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 65%;">
            <strong>Thất bại!</strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif  
    <p><b>Trạng thái: <span class="text-{{ $transaction->getStatus($transaction->t_status)['class'] }}">{{ $transaction->getStatus($transaction->t_status)['name'] }}</span></b></p>
    <div>
        @if($transaction->t_status == \App\Models\Transaction::STATUS_CANCEL || $transaction->t_status == \App\Models\Transaction::STATUS_DONE)
            
        @elseif($transaction->t_status == \App\Models\Transaction::STATUS_DEFAULT)
            <a href="{{ route('get_backend.transaction.success', $transaction->id) }}" class="btn btn-sm btn-primary">Xử lý</a>
            <a href="{{ route('get_backend.transaction.done', $transaction->id) }}" class="btn btn-sm btn-success">Hoàn thành</a>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#huydon">
            Huỷ bỏ
            </button>

            <!-- The Modal -->
            <div class="modal" id="huydon">
                <div class="modal-dialog">
                    <form action="{{ route('get_backend.transaction.cancel', $transaction->id) }}" method="POST">
                    @csrf
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Lý do huỷ đơn hàng</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <textarea required name="lyDo" class="lydohuydon" cols="62" rows="5" placeholder="Nhập lý do huỷ đơn hàng..."></textarea>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Gửi lý do huỷ</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('get_backend.transaction.done', $transaction->id) }}" class="btn btn-sm btn-success">Hoàn thành</a>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#huydon">
            Huỷ bỏ
            </button>

            <!-- The Modal -->
            <div class="modal" id="huydon">
                <div class="modal-dialog">
                    <form action="{{ route('get_backend.transaction.cancel', $transaction->id) }}" method="POST">
                    @csrf
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Lý do huỷ đơn hàng</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <textarea required name="lyDo" class="lydohuydon" cols="62" rows="5" placeholder="Nhập lý do huỷ đơn hàng..."></textarea>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Gửi lý do huỷ</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <table class="table table-hover mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Khuyến mãi</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>Thời gian</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $item)    
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <a href="">
                        <img src="{{ pare_url_file($item->product->pro_avatar) ?? '' }}" class="img-thumbnail" style="width: 60px; height: 60px;" alt="">
                    </a>
                </td>
                <td>{{ $item->product->pro_name ?? '' }}</td>
                <td><span class="text-danger">{{ number_format($item->od_price, 0, ',', '.') }} đ</span></td>
                <td>{{ $item->od_sale }}%</td>
                <td>{{ $item->od_qty }}</td>
                <td>
                    @if($item->od_sale)
                        <span class="text-danger">
                            {{ number_format($item->od_price * (100 - $item->od_sale) * $item->od_qty / 100, 0, ',', '.') }} đ
                        </span>
                    @else
                        <span class="text-danger">
                            {{ number_format($item->od_price * $item->od_qty, 0, ',', '.') }} đ
                        </span>
                    @endif
                </td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop