@extends('layouts.app_backend')
@section('title', 'Danh sách bài viết')
@section('content')
    <h1>Quản lý bài viết <a href="{{ route('get_backend.article.create') }}" class="btn btn-xs btn-success">Thêm mới</a></h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; right: 15px; top: 60px; left: 60%;">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <table class="table table-hover" id="jsDataTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Tên bài viết</th>
            <th>Menu</th>
            <th>Thời gian</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $item)    
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <a href="">
                        <img src="{{ pare_url_file($item->a_avatar) }}" class="img-thumbnail" style="width: 60px; height: 60px;" alt="">
                    </a>
                </td>
                <td style="width: 300px">{{ $item->a_name }}</td>
                <td>
                    {{ $item->menu->mn_name ?? '[N\A]' }}
                </td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ route('get_backend.article.update', $item->id) }}" class="btn btn-sm btn-primary">Update</a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="{{ route('get_backend.article.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop