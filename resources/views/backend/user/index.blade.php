@extends('layouts.app_backend')
@section('title', 'Danh sách thành viên')
@section('content')
    <h1>Danh sách thành viên</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%;">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-7">
            <div class="card">
                <div class="p-3">
                    @include('backend.user.list')
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card">
 
            </div>
        </div>
    </div>
@stop