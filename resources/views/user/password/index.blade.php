@extends('layouts.app_user')
@section('title', 'Cập nhật mật khẩu')
@section('content')
    <h1>CẬP NHẬT MẬT KHẨU</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%; margin-top:45px;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @elseif(session('danger'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%; margin-top:45px;">
            <strong>Thất bại!</strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <form method="POST">
        @csrf
        <div class="form-group" style="position: relative;">
            <label for="exampleInputEmail1">Mật khẩu cũ:</label>
            <input type="password" class="form-control" name="password_old" value="" placeholder="********">
            <a style="position: absolute; top:54%; right: 10px; color: #333;"href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
            @if ($errors->first('password_old'))
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_old') }}</small>
            @endif
        </div>
        <div class="form-group" style="position: relative;">
            <label for="exampleInputEmail1">Mật khẩu mới:</label>
            <input type="password" class="form-control" name="password" value="" placeholder="********">
            <a style="position: absolute; top:54%; right: 10px; color: #333;"href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
            @if ($errors->first('password'))
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <div class="form-group" style="position: relative;">
            <label for="exampleInputEmail1">Nhập lại mật khẩu mới:</label>
            <input type="password" class="form-control" name="password_confirm" value="" placeholder="********">
            <a style="position: absolute; top:54%; right: 10px; color: #333;"href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
            @if ($errors->first('password_confirm'))
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_confirm') }}</small>
            @endif                
        </div>    
        <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i> Cập nhật</button>
    </form>
@stop 