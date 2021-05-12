@extends('layouts.app_backend')
@section('title', 'Danh sách nhân viên')
@section('content')
    <h1>Quản lý nhân viên</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 67%;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="p-3">
                    @include('backend.staff.list')
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                @include('backend.staff.form', ['route' => route('get_backend.staff.create')])
            </div>
        </div>
    </div>
@stop