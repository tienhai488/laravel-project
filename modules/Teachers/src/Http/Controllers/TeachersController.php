<?php

namespace Modules\Teachers\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Teachers\src\Http\Requests\TeachersRequest;
use Modules\Teachers\src\Models\Teachers;
use Modules\Teachers\src\Repositories\TeachersRepository;
use Yajra\DataTables\Facades\DataTables;

class TeachersController extends Controller
{
    protected $teacherRepo;
    public function __construct(TeachersRepository $teacherRepo)
    {
        $this->teacherRepo = $teacherRepo;
    }

    public function index()
    {
        return view("teachers::list");
    }
    
    public function add()
    {
        return view("teachers::add");
    }

    public function post_add(TeachersRequest $request)
    {
        $data = $request->except('_token');
        $status = $this->teacherRepo->add($data);

        return redirect()->route('admin.teachers.index')->with('msg', 'Thêm giảng viên thành công!');
    }

    public function data()
    {
        $list = $this->teacherRepo->getFieldList();
        foreach ($list as $key => $item) {
            $item['tgian'] = Carbon::parse($item->created_at)->format('d/m/Y H:i:s');
        }
        return DataTables::of($list)
            ->addColumn('update', function(Teachers $teacher) {
                $linkUpdate = route('admin.teachers.update', $teacher->id);
                return "<a href='$linkUpdate' class='btn btn-warning'>Sửa</a>";
            })
            ->addColumn('delete', function(Teachers $teacher) {
                $linkDelete = route('admin.teachers.delete', $teacher->id);
                return "<a href='$linkDelete' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa!\")'>Xóa</a>";
            })
            ->addColumn('exp', function(Teachers $teacher) {
                return $teacher->exp." năm";
            })
            ->addColumn('image', function(Teachers $teacher) {
                return "<img style='width:200px' src='".$teacher->image."'/>";
            })
            ->rawColumns(['update', 'delete','image'])
            ->addIndexColumn()
            ->toJson();
    }

    public function update($id)
    {
        $teacher = $this->teacherRepo->find($id);
        if ($teacher) {
            return view("teachers::update", compact('teacher'));
        }
        return redirect(route('admin.teachers.index'))->with('msg', 'Không tồn tại giảng viên!')->with('msg_type', 'danger');
    }

    public function post_update(TeachersRequest $request, $id)
    {
        $data = $request->except('_token');
        $status = $this->teacherRepo->update($id, $data);
        
        if ($status) {
            return redirect(route('admin.teachers.index'))->with('msg', 'Cập nhập giảng viên thành công!')->with('msg_type', 'success');
        } else {
            return redirect(route('admin.teachers.index'))->with('msg', 'Cập nhập giảng viên không thành công!')->with('msg_type', 'danger');
        }
    }

    public function delete($id)
    {
        $teacher = $this->teacherRepo->find($id);
        if ($teacher) {
            $status = $this->teacherRepo->delete($id);
            if ($status) {
                return redirect(route('admin.teachers.index'))->with('msg', 'Xóa giảng viên thành công!')->with('msg_type', 'success');
            } else {
                return redirect(route('admin.teachers.index'))->with('msg', 'Xóa giảng viên không thành công!')->with('msg_type', 'danger');
            }
        }
        return redirect(route('admin.teachers.index'))->with('msg', 'Không tồn tại giảng viên!')->with('msg_type', 'danger');
    }
}