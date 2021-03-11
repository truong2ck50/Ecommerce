<form class="p-3" action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="c_name" value="{{ old('c_name', $category->c_name ?? '') }}">
        @if ($errors->first('c_name'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('c_name') }}</small>
        @endif
    </div>
    <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" value="0" name="c_hot" {{($category->c_hot ?? 0) == 0 ? "checked" : ""}} class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline1">Mặc định</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" value="1" name="c_hot" {{($category->c_hot ?? 0) == 1 ? "checked" : ""}} class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline2">Nổi bật</label>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" accept="image/*" id="customFile" name="c_avatar">
            <label class="custom-file-label" for="customFile">Chọn ảnh</label>
        </div>
        @if(isset($category) && $category->c_avatar)
            <img src="{{ pare_url_file($category->c_avatar) }}" class="img-thumbnail" 
            style="width: 100%; height: auto; max-width: 100%; margin-top: 15px" alt="">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>