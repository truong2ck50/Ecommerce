@extends('layouts.app_backend')
@section('title', 'Cập nhật tags')
@section('content')
    <h1>Danh sách tags</h1>
    <div class="row">
        <div class="col-sm-7">
            <div class="card">
                <div class="p-3">
                    <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $item) 
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->t_name }}</td>
                            <td>{{ $item->t_slug }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('get_backend.tag.update', $item->id) }}" class="btn btn-xs btn-primary">Update</a>
                                <a href="{{ route('get_backend.tag.delete', $item->id) }}" class="btn btn-xs btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card">
                @include('backend.tag.form', ['route' => route('get_backend.tag.update', $tag->id)])
            </div>
        </div>
    </div>
@stop