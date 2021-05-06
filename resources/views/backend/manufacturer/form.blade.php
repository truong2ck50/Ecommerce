<form class="p-3" action="{{ $route }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1"><b>Tên hãng:</b></label>
        <input type="text" class="form-control" name="m_name" value="{{ old('m_name', $manufacturer->m_name ?? '') }}">
        @if ($errors->first('m_name'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('m_name') }}</small>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>