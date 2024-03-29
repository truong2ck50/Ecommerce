<form method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="p-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Tên bài viết:</b></label>
                        <input type="text" class="form-control" name="a_name" value="{{ old('a_name', $article->a_name ?? '') }}">
                        @if ($errors->first('a_name'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('a_name') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Menu:</b></label>
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
                        <label for="exampleInputEmail1"><b>Từ khoá:</b></label>
                        <select name="tags[]" class="form-control js-tags" id="" multiple>
                            <option value="">--Chọn từ khoá--</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, $tagsOld) ? "selected" : ""}}>{{ $tag->t_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Mô tả:</b></label>
                        <textarea name="a_description" class="form-control" id="editor1" cols="30" rows="3">{{ old('a_description', $article->a_description ?? '') }}</textarea>
                        @if ($errors->first('a_description'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('a_description') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Nội dung:</b></label>
                        <textarea name="a_content" class="form-control" id="editor2" cols="30" rows="3">{{ old('a_content', $article->a_content ?? '') }}</textarea>
                        @if ($errors->first('a_content'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('a_content') }}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="p-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Hình ảnh:</b></label>
                        <div class="custom-file">                            
                            <input type="file" class="custom-file-input" accept="image/*" id="customFile" name="a_avatar">
                            <label class="custom-file-label" for="customFile">Chọn hình ảnh</label>
                        </div>
                        @if(isset($article) && $article->a_avatar)
                            <img src="{{ pare_url_file($article->a_avatar) }}" class="img-thumbnail" 
                            style="width: 100%; height: auto; max-width: 100%; margin-top: 15px" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Lưu thông tin</button>
 </form>
<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
 <script>
    CKEDITOR.replace('editor2');
</script>