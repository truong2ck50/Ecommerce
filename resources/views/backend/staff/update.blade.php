@extends('layouts.app_backend')
@section('title', 'Cập nhật danh mục')
@section('content')
    <h1>Danh sách danh mục</h1>
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
                @include('backend.staff.form', ['route' => route('get_backend.staff.update', $staff->id)])
            </div>
        </div>
    </div>
@stop