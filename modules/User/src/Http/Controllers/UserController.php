<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Models\User;
use Modules\User\src\Repositories\UserRepository;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view("user::list");
    }
    public function add()
    {
        return view("user::add");
    }

    public function post_add(UserRequest $request)
    {
        $data = $request->except('_token', 'password');
        $data['password'] = Hash::make($request->password);
        $this->userRepo->add($data);

        return redirect()->route('admin.users.index')->with('msg', 'Thêm người dùng thành công!');
    }

    public function data()
    {
        $list = $this->userRepo->getFieldList();
        foreach ($list as $key => $user) {
            $formattedDate = Carbon::parse($user->created_at)->format('d/m/Y H:i:s');

            $user['tgian'] = $formattedDate;

        }
        return DataTables::of($list)
            ->addColumn('update', function(User $user) {
                $linkUpdate = route('admin.users.update', $user->id);
                return "<a href='$linkUpdate' class='btn btn-warning'>Sửa</a>";
            })
            ->addColumn('delete', function(User $user) {
                $linkDelete = route('admin.users.delete', $user->id);
                return "<a href='$linkDelete' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa!\")'>Xóa</a>";
            })
            ->rawColumns(['update', 'delete'])
            ->addIndexColumn()
            ->toJson();
    }

    public function update($id)
    {
        $user = $this->userRepo->find($id);
        if ($user) {
            return view("user::update", compact('user'));
        }
        return redirect(route('admin.users.index'))->with('msg', 'Không tồn tại người dùng!')->with('msg_type', 'danger');
    }

    public function post_update(UserRequest $request, $id)
    {
        $data = $request->except('_token', 'password');
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $status = $this->userRepo->update($id, $data);

        if ($status) {
            return redirect(route('admin.users.index'))->with('msg', 'Cập nhập người dùng thành công!')->with('msg_type', 'success');
        } else {
            return redirect(route('admin.users.index'))->with('msg', 'Cập nhập người dùng không thành công!')->with('msg_type', 'danger');
        }
    }

    public function delete($id)
    {
        $user = $this->userRepo->find($id);
        if ($user) {
            $status = $this->userRepo->delete($id);
            if ($status) {
                return redirect(route('admin.users.index'))->with('msg', 'Xóa người dùng thành công!')->with('msg_type', 'success');
            } else {
                return redirect(route('admin.users.index'))->with('msg', 'Xóa người dùng không thành công!')->with('msg_type', 'danger');
            }
        }
        return redirect(route('admin.users.index'))->with('msg', 'Không tồn tại người dùng!')->with('msg_type', 'danger');
    }
}