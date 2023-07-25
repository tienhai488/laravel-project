<?php

namespace Modules\Courses\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Models\Course;
use Modules\Courses\src\Models\Courses;
use Modules\Courses\src\Repositories\CoursesRepository;
use Yajra\DataTables\Facades\DataTables;

class CoursesController extends Controller
{
    protected $coursesRepo,$cateRepo;
    public function __construct(CoursesRepository $coursesRepo,CategoriesRepository $cateRepo)
    {
        $this->coursesRepo = $coursesRepo;
        $this->cateRepo = $cateRepo;
    }

    public function index()
    {
        return view("courses::list");
    }
    
    public function add()
    {
        $categories = $this->cateRepo->getAll();
        return view("courses::add",compact('categories'));
    }

    public function post_add(CoursesRequest $request)
    {
        $data = $request->except('_token');
        $course = $this->coursesRepo->add($data);

        $dataCate = [];
        foreach ($data['categories'] as $value) {
            $dataCate[$value] = ['created_at' => date('Y-m-d H:i:s')];
        }

        $course->categories()->attach($dataCate);

        return redirect()->route('admin.courses.index')->with('msg', 'Thêm khóa học thành công!');
    }

    public function data()
    {
        $list = $this->coursesRepo->getFieldList();
        foreach ($list as $key => $item) {
            $item['tgian'] = Carbon::parse($item->created_at)->format('d/m/Y H:i:s');
        }
        return DataTables::of($list)
            ->addColumn('update', function(Courses $course) {
                $linkUpdate = route('admin.courses.update', $course->id);
                return "<a href='$linkUpdate' class='btn btn-warning'>Sửa</a>";
            })
            ->addColumn('delete', function(Courses $course) {
                $linkDelete = route('admin.courses.delete', $course->id);
                return "<a href='$linkDelete' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa!\")'>Xóa</a>";
            })
            ->addColumn('status', function (Courses $course) {
                $statusLabel = $course->status == 1 ? "Đã ra mắt" : "Chưa ra mắt";
                $statusClass = $course->status == 1 ? "btn btn-primary" : "btn btn-danger";
                return "<button class='$statusClass btn-sm'>$statusLabel</button>";
            })
            ->addColumn('price', function (Courses $course) {
                if(!empty($course->sale_price)){
                    $price = number_format($course->sale_price);
                }else{
                    $price = number_format($course->price);
                }
                return $price."đ";
            })
            ->rawColumns(['update', 'delete','status'])
            ->addIndexColumn()
            ->toJson();
    }

    public function update($id)
    {
        $course = $this->coursesRepo->find($id);
        if ($course) {
            $categories = $this->cateRepo->getAll();
            $dataCate = $course->categories->pluck('id')->toArray();
            return view("courses::update", compact('course','categories','dataCate'));
        }
        return redirect(route('admin.courses.index'))->with('msg', 'Không tồn tại khóa học!')->with('msg_type', 'danger');
    }

    public function post_update(CoursesRequest $request, $id)
    {
        $data = $request->except('_token');
        $status = $this->coursesRepo->update($id, $data);

        $course = $this->coursesRepo->find($id);
        $dataCate = [];
        foreach ($data['categories'] as $value) {
            $dataCate[$value] = ['updated_at' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s')];
        }

        $course->categories()->sync($dataCate);

        if ($status) {
            return redirect(route('admin.courses.index'))->with('msg', 'Cập nhập khóa học thành công!')->with('msg_type', 'success');
        } else {
            return redirect(route('admin.courses.index'))->with('msg', 'Cập nhập khóa học không thành công!')->with('msg_type', 'danger');
        }
    }

    public function delete($id)
    {
        $course = $this->coursesRepo->find($id);
        if ($course) {
            $dataCate = $course->categories->pluck('id')->toArray();
            $course->categories()->detach($dataCate);
            
            $status = $this->coursesRepo->delete($id);
            if ($status) {
                return redirect(route('admin.courses.index'))->with('msg', 'Xóa khóa học thành công!')->with('msg_type', 'success');
            } else {
                return redirect(route('admin.courses.index'))->with('msg', 'Xóa khóa học không thành công!')->with('msg_type', 'danger');
            }
        }
        return redirect(route('admin.courses.index'))->with('msg', 'Không tồn tại khóa học!')->with('msg_type', 'danger');
    }
}