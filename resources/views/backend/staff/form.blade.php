<form class="p-3" action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1"><b>Tên nhân viên:</b></label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $staff->name ?? '') }}">
        @if ($errors->first('name'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"><b>Email:</b></label>
        <input type="email" class="form-control" name="email" value="{{ old('email', $staff->email ?? '') }}">
        @if ($errors->first('email'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"><b>Mật khẩu:</b></label>
        <input type="password" class="form-control" name="password" value="">
        @if ($errors->first('password'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"><b>Số điện thoại:</b></label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone', $staff->phone ?? '') }}">
        @if ($errors->first('phone'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('phone') }}</small>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"><b>Địa chỉ:</b></label>
        <input type="text" class="form-control" name="address" value="{{ old('address', $staff->address ?? '') }}">
        @if ($errors->first('address'))
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('address') }}</small>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
</form>