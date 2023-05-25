@extends('admin.layouts.admin')
@section('title', 'Thêm danh mục')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
    @endif
    <form class="row" method="POST">
        @csrf
        <div class="form-group col-6">
            <label for="">Tên danh mục</label>
            <input name="name" type="text"
                class="form-control form-name {{ $errors->any() ? ($errors->has('name') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Tên danh mục..." value="{{ old('name') }}" />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Slug</label>
            <input name="slug" type="text"
                class="form-control form-slug {{ $errors->any() ? ($errors->has('slug') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Slug..." value="{{ old('slug') }}" />
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div style="padding-left: 12px">
            <button type="submit" class="btn btn-primary btn-block">Thêm danh mục</button>
            <a href="{{ route('admin.categories.index') }}">Quay lại</a>
        </div>
    </form>
@endsection

@section('script')
    <script>
        handleSlug();
    </script>
@endsection
