@extends('layouts.app_backend')
@section('title', 'Danh sách danh mục')
@section('content')
    <h1>Quản lý danh mục</h1>
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
                    @include('backend.category.list')
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                @include('backend.category.form', ['route' => route('get_backend.category.store')])
            </div>
        </div>
    </div>
@stop