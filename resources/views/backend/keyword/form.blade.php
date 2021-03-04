<form class="p-3" action="{{ $route }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="k_name" value="{{ old('k_name', $keyword->k_name ?? '') }}">
        <label for="exampleInputEmail1">Name</label>
        @if ($errors->first('k_name'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('k_name') }}</small>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>