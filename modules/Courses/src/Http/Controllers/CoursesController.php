<?php

namespace Modules\Courses\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Models\Course;
use Modules\Courses\src\Repositories\CoursesRepository;
use Yajra\DataTables\Facades\DataTables;

class CoursesController extends Controller
{
    protected $coursesRepo;
    public function __construct(CoursesRepository $coursesRepo)
    {
        $this->coursesRepo = $coursesRepo;
    }

    public function index()
    {
        return view("courses::list");
    }
    
    public function add()
    {
        return view("courses::add");
    }

    // public function post_add(UserRequest $request)
    // {
    //     $data = $request->except('_token', 'password');
    //     $data['password'] = Hash::make($request->password);
    //     $this->coursesRepo->add($data);

    //     return redirect()->route('admin.users.index')->with('msg', 'Thêm người dùng thành công!');
    // }

    // public function data()
    // {
    //     $list = $this->coursesRepo->getFieldList();
    //     foreach ($list as $key => $item) {
    //         $item['tgian'] = Carbon::parse($item->created_at)->format('d/m/Y H:i:s');
    //     }
    //     return DataTables::of($list)
    //         ->addColumn('update', function(User $user) {
    //             $linkUpdate = route('admin.users.update', $user->id);
    //             return "<a href='$linkUpdate' class='btn btn-warning'>Sửa</a>";
    //         })
    //         ->addColumn('delete', function(User $user) {
    //             $linkDelete = route('admin.users.delete', $user->id);
    //             return "<a href='$linkDelete' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa!\")'>Xóa</a>";
    //         })
    //         ->rawColumns(['update', 'delete'])
    //         ->addIndexColumn()
    //         ->toJson();
    // }

    // public function update($id)
    // {
    //     $user = $this->coursesRepo->find($id);
    //     if ($user) {
    //         return view("user::update", compact('user'));
    //     }
    //     return redirect(route('admin.users.index'))->with('msg', 'Không tồn tại người dùng!')->with('msg_type', 'danger');
    // }

    // public function post_update(UserRequest $request, $id)
    // {
    //     $data = $request->except('_token', 'password');
    //     if (!empty($request->password)) {
    //         $data['password'] = Hash::make($request->password);
    //     }
    //     $status = $this->coursesRepo->update($id, $data);

    //     if ($status) {
    //         return redirect(route('admin.users.index'))->with('msg', 'Cập nhập người dùng thành công!')->with('msg_type', 'success');
    //     } else {
    //         return redirect(route('admin.users.index'))->with('msg', 'Cập nhập người dùng không thành công!')->with('msg_type', 'danger');
    //     }
    // }

    // public function delete($id)
    // {
    //     $user = $this->coursesRepo->find($id);
    //     if ($user) {
    //         $status = $this->coursesRepo->delete($id);
    //         if ($status) {
    //             return redirect(route('admin.users.index'))->with('msg', 'Xóa người dùng thành công!')->with('msg_type', 'success');
    //         } else {
    //             return redirect(route('admin.users.index'))->with('msg', 'Xóa người dùng không thành công!')->with('msg_type', 'danger');
    //         }
    //     }
    //     return redirect(route('admin.users.index'))->with('msg', 'Không tồn tại người dùng!')->with('msg_type', 'danger');
    // }
}