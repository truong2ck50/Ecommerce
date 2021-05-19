<table class="table table-hover" id="jsDataTable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên nhân viên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Địa chỉ</th>
        <th>Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @foreach($staffs as $item)    
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td style="width: 200px;">{{ $item->address }}</td>
            <td>
                <a href="{{ route('get_backend.staff.update', $item->id) }}" class="btn btn-sm btn-primary">Update</a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="{{ route('get_backend.staff.delete', $item->id) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>