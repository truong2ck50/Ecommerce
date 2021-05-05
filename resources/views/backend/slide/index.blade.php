@extends('layouts.app_backend')
@section('title', 'Danh sách slide')
@section('content')
    <h1>Danh sách slide</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 68%;">
            <p>{{ session('success') }}</p>
        </div>
    @endif
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
                @include('backend.slide.form', ['route' => route('get_backend.slide.store')])
            </div>
        </div>
    </div>>
@stop