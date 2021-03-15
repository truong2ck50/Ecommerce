<form method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="p-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="pro_name" value="{{ old('pro_name', $product->pro_name ?? '') }}">
                        @if ($errors->first('pro_name'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('pro_name') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select name="pro_category_id" class="form-control" id="">
                            <option value="">--Chọn danh mục--</option>
                            @foreach($categories as $item)
                                <option value="{{ $item->id }}" {{ old('pro_category_id', $product->pro_category_id ?? 0) == $item->id ? "selected" : ""}}>{{ $item->c_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('pro_category_id'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('pro_category_id') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="pro_description" class="form-control" id="" cols="30" rows="3">{{ old('pro_description', $product->pro_description ?? '') }}</textarea>
                        @if ($errors->first('pro_description'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('pro_description') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Từ khoá</label>
                        <select name="keywords[]" class="form-control js-tags" id="" multiple>
                            <option value="">--Chọn từ khoá--</option>
                            @foreach($keywords as $keyword)
                                <option value="{{ $keyword->id }}" {{ in_array($keyword->id, $keywordOld) ? "selected" : ""}}>{{ $keyword->k_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Content</label>
                        <textarea name="pro_content" class="form-control" id="" cols="30" rows="3">{{ old('pro_content', $product->pro_content ?? '') }}</textarea>
                        @if ($errors->first('pro_content'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('pro_content') }}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="p-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                            <input type="text" class="form-control" name="pro_price" value="{{ old('pro_price', $product->pro_price ?? '0') }}">
                            @if ($errors->first('pro_price'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('pro_price') }}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Number</label>
                        <input type="text" class="form-control" name="pro_number" value="{{ old('pro_number', $product->pro_number ?? '0') }}">
                        @if ($errors->first('pro_number'))
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('pro_number') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" value="0" name="pro_hot" {{($product->pro_hot ?? 0) == 0 ? "checked" : ""}} class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">Mặc định</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" value="1" name="pro_hot" {{($product->pro_hot ?? 0) == 1 ? "checked" : ""}} class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">Nổi bật</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" accept="image/*" id="customFile" name="pro_avatar">
                            <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                        </div>
                        @if(isset($product) && $product->pro_avatar)
                            <img src="{{ pare_url_file($product->pro_avatar) }}" class="img-thumbnail" 
                            style="width: 100%; height: auto; max-width: 100%; margin-top: 15px" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Lưu</button>
 </form>