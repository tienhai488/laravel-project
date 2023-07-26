@extends('admin.layouts.admin')
@section('title', 'Thêm giảng viên')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
    @endif
    <form class="row" method="POST">
        @csrf
        <div class="form-group col-6">
            <label for="">Tên giảng viên</label>
            <input name="name" type="text"
                class="form-control form-name {{ $errors->any() ? ($errors->has('name') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Tên giảng viên..." value="{{ old('name') }}" />
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
            <label for="">Sô năm kinh nghiệm</label>
            <input name="exp" type="number"
                class="form-control {{ $errors->any() ? ($errors->has('exp') ? 'is-invalid' : 'is-valid') : '' }}"
                placeholder="Sô năm kinh nghiệm..." value="{{ old('exp') }}" />
            @error('exp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="form-group col-12">
            <label for="">Giới thiệu giảng viên</label>
            <textarea class="form-control editor" placeholder="Giới thiệu giảng viên..." name="description" cols="30"
                rows="10">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback" style="display: contents">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-12 mb-4">
            <div class="row align-items-end">
                <div class="col-8">
                    <label for="">Ảnh đại diện</label>
                    <input id="thumbnail" type="text" class="form-control" placeholder="Ảnh đại diện..." name="image"
                        value="{{ old('image') }}">
                </div>
                <div class="col-1">
                    <button id="lfm" data-input="thumbnail" data-preview="holderddd" class="btn btn-primary">Choose
                    </button>
                </div>
                <div class="col-3" id="holder">
                </div>
            </div>
            @error('image')
                <div class="invalid-feedback" style="display: contents">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div style="padding-left: 12px">
            <button type="submit" class="btn btn-primary btn-block">Thêm giảng viên</button>
            <a href="{{ route('admin.teachers.index') }}">Quay lại</a>
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
