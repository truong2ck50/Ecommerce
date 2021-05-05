@extends('layouts.app_user')
@section('title', 'Cập nhật thông tin')
@section('content')
    <h1>Cập nhật thông tin</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%; margin-top:45px;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%; margin-top: 45px;">
            <strong>Thất bại!</strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Họ tên:</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Địa chỉ:</label>
            <input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="Địa chỉ">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Số điện thoại:</label>
            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Số điện thoại">
        </div>    
    
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Cập nhật</button>
    </form>
@stop