<form class="p-3" action="{{ $route }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="mn_name" value="{{ old('mn_name', $menu->mn_name ?? '') }}">
        <label for="exampleInputEmail1">Name</label>
        @if ($errors->first('mn_name'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mn_name') }}</small>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>