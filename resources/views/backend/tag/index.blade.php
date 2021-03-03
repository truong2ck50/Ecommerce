@extends('layouts.app_backend')
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
                                <a href="" class="btn btn-xs btn-primary">Update</a>
                                <a href="" class="btn btn-xs btn-danger">Delete</a>
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
                <form class="p-3" action="{{ route('get_backend.tag.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="t_name" aria-describedby="emailHelp">
                        @if ($errors->first('t_name'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('t_name') }}</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@stop