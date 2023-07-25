@extends('admin.layouts.admin')
@section('title', 'Thêm khóa học')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
    @endif
    <form class="row" method="POST">
        @csrf
        <div class="form-group col-6">
            <label for="">Tên khóa học</label>
            <input name="name" type="text"
                class="form-control form-name {{ $errors->any() ? ($errors->has('name') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Tên khóa học..." value="{{ old('name') }}" />
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
        <div class="form-group col-6">
            <label for="">Giảng viên</label>
            <select name="teacher_id"
                class="form-control {{ $errors->any() ? ($errors->has('teacher_id') ? 'is-invalid' : 'is-valid') : '' }}">
                <option value="0">Vui lòng chọn giảng viên</option>
                <option value="1" {{ old('teacher_id') == 1 ? 'selected' : false }}>TienHai</option>
            </select>
            @error('teacher_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Mã khóa học</label>
            <input name="code" type="text"
                class="form-control {{ $errors->any() ? ($errors->has('code') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Mã khóa học..." value="{{ old('code') }}" />
            @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Giá khóa học</label>
            <input name="price" type="text"
                class="form-control {{ $errors->any() ? ($errors->has('price') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Giá khóa học..." value="{{ old('price') }}" />
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Giá khuyến mãi</label>
            <input name="sale_price" type="text"
                class="form-control {{ $errors->any() ? ($errors->has('sale_price') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Giá khuyến mãi..." value="{{ old('sale_price') }}" />
            @error('sale_price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Tài liệu hỗ trợ</label>
            <select name="is_document"
                class="form-control {{ $errors->any() ? ($errors->has('is_document') ? 'is-invalid' : 'is-valid') : '' }}">
                <option value="0" {{ old('is_document') == 0 ? 'selected' : false }}>Không</option>
                <option value="1" {{ old('is_document') == 1 ? 'selected' : false }}>Có</option>
            </select>
            @error('is_document')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="">Tình trạng khóa học</label>
            <select name="status"
                class="form-control {{ $errors->any() ? ($errors->has('status') ? 'is-invalid' : 'is-valid') : '' }}">
                <option value="0" {{ old('status') == 0 ? 'selected' : false }}>Chưa ra mắt</option>
                <option value="1" {{ old('status') == 1 ? 'selected' : false }}>Ra mắt</option>
            </select>
            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="">Hỗ trợ học viên</label>
            <textarea class="form-control editor" placeholder="Hỗ trợ học viên..." name="support" cols="30" rows="10">{{ old('support') }}</textarea>
            @error('support')
                <div class="invalid-feedback" style="display: contents">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="">Mô tả khóa học</label>
            <textarea class="form-control editor" placeholder="Mô tả khóa học..." name="detail" cols="30" rows="10">{{ old('detail') }}</textarea>
            @error('detail')
                <div class="invalid-feedback" style="display: contents">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="">Danh mục khóa học</label>
            <div class="list-cate">
                @foreach ($categories as $cate)
                    <div>
                        <input type="checkbox" id="cate-{{ $cate->id }}" class="" name="categories[]"
                            value="{{ $cate->id }}"
                            {{ checkCategory($cate->id, old('categories')) ? 'checked' : false }}>
                        <label for="cate-{{ $cate->id }}">{{ $cate->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('categories')
                <div class="invalid-feedback" style="display: contents">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-12 mb-4">
            <div class="row align-items-end">
                <div class="col-8">
                    <label for="">Ảnh đại diện</label>
                    <input id="thumbnail" type="text" class="form-control" placeholder="Ảnh đại diện..."
                        name="thumbnail" value="{{ old('thumbnail') }}">
                </div>
                <div class="col-1">
                    <button id="lfm" data-input="thumbnail" data-preview="holderddd"
                        class="btn btn-primary">Choose
                    </button>
                </div>
                <div class="col-3" id="holder">
                </div>
            </div>
            @error('thumbnail')
                <div class="invalid-feedback" style="display: contents">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div style="padding-left: 12px">
            <button type="submit" class="btn btn-primary btn-block">Thêm khóa học</button>
            <a href="{{ route('admin.courses.index') }}">Quay lại</a>
        </div>
    </form>

@endsection

@section('style')
    <style>
        #holder img {
            border: 1px solid black;
            width: 100% !important;
            height: auto !important;
        }

        .list-cate {
            max-height: 200px;
            overflow: auto;
        }
    </style>
@endsection

@section('script')
    <script>
        const editors = document.querySelectorAll(".editor");
        editors.forEach((item, index) => {
            item.id = "editor" + index;
            CKEDITOR.replace("editor" + index);
        });

        $('#lfm').filemanager('image');

        const holder = document.querySelector("#holder");
        const thumbnail = document.querySelector("#thumbnail");

        if (thumbnail.value) {
            let img = document.createElement('img');
            holder.appendChild(img);
            holder.querySelector('img').src = thumbnail.value;
        }

        thumbnail.onchange = () => {
            holder.innerHTML = "";
            if (thumbnail.value) {
                let img = document.createElement('img');
                holder.appendChild(img);
                holder.querySelector('img').src = thumbnail.value;
            }
        };

        handleSlug();
    </script>
@endsection
