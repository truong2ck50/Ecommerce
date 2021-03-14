@extends('layouts.app_backend')
@section('title', 'Cập nhật slide')
@section('content')
    <h1>Danh sách slide</h1>
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="p-3">
                    @include('backend.slide.list')
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                @include('backend.slide.form', ['route' => route('get_backend.slide.update', $slide->id)])
            </div>
        </div>
    </div>
@stop