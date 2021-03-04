<form method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-7">
            <div class="card">
                <div class="p-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="a_name" value="{{ old('a_name', $article->a_name ?? '') }}">
                        @if ($errors->first('a_name'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('a_name') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Menu</label>
                        <select name="a_menu_id" class="form-control" id="">
                            <option value="">--Chọn menu--</option>
                            @foreach($menus as $item)
                                <option value="{{ $item->id }}" {{ old('a_menu_id', $article->a_menu_id ?? 0) == $item->id ? "selected" : ""}}>{{ $item->mn_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('a_menu_id'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('a_menu_id') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="a_description" class="form-control" id="" cols="30" rows="3">{{ old('a_description', $article->a_description ?? '') }}</textarea>
                        @if ($errors->first('a_description'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('a_description') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
                        <textarea name="a_content" class="form-control" id="" cols="30" rows="3">{{ old('a_content', $article->a_content ?? '') }}</textarea>
                        @if ($errors->first('a_content'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('a_content') }}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card">
                <div class="p-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" id="customFile" name="a_avatar">
                        <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Lưu</button>
 </form>