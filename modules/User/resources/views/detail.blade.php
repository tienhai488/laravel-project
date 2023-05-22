@extends('layouts.client')
@section('title', 'Chi tiet nguoi dung')
@section('content')
    <h1>{{ trans('user::detail.title', ['name' => 'TienHai']) }} : {{ $id }}</h1>
@endsection
