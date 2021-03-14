<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Title</th>
        <th>Description</th>
        <th>Link</th>
        <th>Time</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($slides as $item)    
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                <a href="">
                    <img src="{{ pare_url_file($item->s_banner) }}" class="img-thumbnail" style="width: 60px; height: 60px;" alt="">
                </a>
            </td>
            <td>{{ $item->s_title }}</td>
            <td>{{ $item->s_description }}</td>
            <td>{{ $item->s_link }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
                <a href="{{ route('get_backend.slide.update', $item->id) }}" class="btn btn-xs btn-primary">Update</a>
                <a href="{{ route('get_backend.slide.delete', $item->id) }}" class="btn btn-xs btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>