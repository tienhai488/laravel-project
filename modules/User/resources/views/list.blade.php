@extends('admin.layouts.admin')
@section('title', 'Danh sách người dùng')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Cập nhập</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>TienHai</td>
                            <td>tienhai@gmail.com</td>
                            <td>Người dùng</td>
                            <td><a href="" class="btn btn-warning">Cập nhập</a></td>
                            <td><a href="" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
