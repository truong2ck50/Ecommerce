<table class="table table-hover" id="jsDataTable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Hình ảnh</th>
        <th>Tên</th>
        <th>Parent</th>
        <th>Slug</th>
        <th>Hot</th>
        <th>Thời gian</th>
        <th>Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $item)    
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                <a href="">
                    <img src="{{ pare_url_file($item->c_avatar) }}" class="img-thumbnail" style="width: 60px; height: 60px;" alt="">
                </a>
            </td>
            <td style="width: 100px;">{{ $item->c_name }}</td>
            <td>{{ $item->parent->c_name ?? "__ROOT__" }}</td>
            <td style="width: 100px;">{{ $item->c_slug }}</td>
            <td>
                <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline" value="1" {{$item->c_hot == 1 ? "checked" : ""}} class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Nổi bật</label>
                    </div>
            </td>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('get_backend.category.update', $item->id) }}" class="btn btn-sm btn-primary">Update</a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="{{ route('get_backend.category.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>