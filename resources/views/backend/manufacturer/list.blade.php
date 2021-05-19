<table class="table table-hover" id="jsDataTable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Hãng</th>
        <th>Slug</th>
        <th>Thời gian</th>
        <th>Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @foreach($manufacturers as $item)    
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->m_name }}</td>
            <td>{{ $item->m_slug }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
                <a href="{{ route('get_backend.manufacturer.update', $item->id) }}" class="btn btn-sm btn-primary">Update</a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="{{ route('get_backend.manufacturer.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>