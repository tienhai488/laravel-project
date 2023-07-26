@extends('admin.layouts.admin')
@section('title', 'Danh sách giảng viên')
@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.teachers.add') }}" class="btn btn-primary">Thêm giảng viên</a>
    </div>
    @if (session('msg'))
        <div class="alert alert-{{ session('msg_type') ?? 'success' }}">{{ session('msg') }}</div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên giảng viên</th>
                            <th>Ảnh đại diện</th>
                            <th>Kinh nghiệm</th>
                            <th>Thời gian</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.teachers.data') }}',
                "columns": [{
                        'data': 'DT_RowIndex'
                    },
                    {
                        'data': 'name'
                    },
                    {
                        'data': 'image'
                    },
                    {
                        'data': 'exp'
                    },
                    {
                        'data': 'tgian'
                    },
                    {
                        'data': 'update'
                    },
                    {
                        'data': 'delete'
                    },
                ],
            });
        });
    </script>
@endsection
