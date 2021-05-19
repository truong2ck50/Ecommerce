<table class="table table-hover" id="jsDataTable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên KH</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Thời gian</th>
        <th>Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $item)    
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="{{ route('get_backend.user.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>