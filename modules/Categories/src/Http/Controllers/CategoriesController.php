<?php

namespace Modules\Categories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Categories\src\Http\Requests\CategoriesRequest;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    protected $cateRepo;
    public function __construct(CategoriesRepository $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }

    public function index()
    {
        return view("categories::list");
    }
    public function add()
    {
        return view("categories::add");
    }

    public function post_add(CategoriesRequest $request)
    {
        $data = $request->except('_token');
        $this->cateRepo->add($data);

        return redirect()->route('admin.categories.index')->with('msg', 'Thêm danh mục thành công!')->with('msg_type', 'success');
    }

    public function data()
    {
        $list = $this->cateRepo->getAll();
        foreach ($list as $key => $item) {
            $item['tgian'] = Carbon::parse($item->created_at)->format('d/m/Y H:i:s');
        }
        return DataTables::of($list)
            ->addColumn('update', function(Category $cate) {
                $linkUpdate = route('admin.categories.update', $cate->id);
                return "<a href='$linkUpdate' class='btn btn-warning'>Sửa</a>";
            })
            ->addColumn('delete', function(Category $cate) {
                $linkDelete = route('admin.categories.delete', $cate->id);
                return "<a href='$linkDelete' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa!\")'>Xóa</a>";
            })
            ->rawColumns(['update', 'delete'])
            ->addIndexColumn()
            ->toJson();
    }

    public function update($id)
    {
        $cate = $this->cateRepo->find($id);
        if ($cate) {
            return view("categories::update", compact('cate'));
        }
        return redirect(route('admin.categories.index'))->with('msg', 'Không tồn tại danh mục!')->with('msg_type', 'danger');
    }

    public function post_update(CategoriesRequest $request, $id)
    {
        $data = $request->except('_token');
        $status = $this->cateRepo->update($id, $data);

        if ($status) {
            return redirect(route('admin.categories.index'))->with('msg', 'Cập nhập danh mục thành công!')->with('msg_type', 'success');
        } else {
            return redirect(route('admin.categories.index'))->with('msg', 'Cập nhập danh mục không thành công!')->with('msg_type', 'danger');
        }
    }

    public function delete($id)
    {
        $msg = "";
        $msg_type = "";
        $user = $this->cateRepo->find($id);
        if ($user) {
            $status = $this->cateRepo->delete($id);
            if ($status) {
                $msg = 'Xóa danh mục thành công!';
                $msg_type = 'success';
            } else {
                $msg = 'Xóa danh mục không thành công!';
                $msg_type = 'danger';
            }
        }else{
            $msg = 'Không tồn tại danh mục!';
            $msg_type = 'danger';
        }
        return redirect(route('admin.categories.index'))->with('msg', $msg)->with('msg_type', $msg_type);
    }
}