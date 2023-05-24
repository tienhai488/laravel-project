@extends('admin.layouts.admin')
@section('title', 'Thêm người dùng')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
    @endif
    <form class="row" method="POST">
        @csrf
        <div class="form-group col-6">
            <label for="">Họ tên</label>
            <input name="name" type="text"
                class="form-control {{ $errors->any() ? ($errors->has('name') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Họ tên..." value="{{ old('name') }}" />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Email</label>
            <input name="email" type="text"
                class="form-control {{ $errors->any() ? ($errors->has('email') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Email..." value="{{ old('email') }}" />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Nhóm người dùng</label>
            <select name="group_id"
                class="form-control {{ $errors->any() ? ($errors->has('group_id') ? 'is-invalid' : 'is-valid') : '' }}">
                <option value="0">Vui lòng chọn nhóm</option>
                <option value="1" {{ old('group_id') == 1 ? 'selected' : false }}>Admin</option>
                <option value="2" {{ old('group_id') == 2 ? 'selected' : false }}>Quản lý</option>
                <option value="3" {{ old('group_id') == 3 ? 'selected' : false }}>Người dùng thường</option>
            </select>
            @error('group_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Mật khẩu</label>
            <input name="password" type="password"
                class="form-control {{ $errors->any() ? ($errors->has('password') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Mật khẩu" />
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div style="padding-left: 12px">
            <button type="submit" class="btn btn-primary btn-block">Thêm người dùng</button>
            <a href="{{ route('admin.users.index') }}">Quay lại</a>
        </div>
    </form>

@endsection
