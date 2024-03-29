@extends('layouts.app_user')
@section('title', 'Đánh giá sản phẩm')
@section('content')
    <h1>Đánh giá sản phẩm {{$pro->pro_name}}</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%; margin-top:45px;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Nội dung đánh giá</label>
            <textarea name="v_content" required class="form-control" id="" cols="30" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Bình chọn</label>
            <select name="v_number" required class="form-control" id="">
                <option value="5">Rất tốt</option>
                <option value="4">Tốt</option>
                <option value="3">Bình thường</option>
                <option value="2">Trung bình</option>
                <option value="1">Kém</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Xác nhận</button>
    </form>
@stop