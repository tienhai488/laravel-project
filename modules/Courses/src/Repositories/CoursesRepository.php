<?php

namespace Modules\Courses\src\Repositories;
use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Courses;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Courses::class;
    }

    public function getCourses($limit = 10)
    {
        return $this->model->limit($limit)->get();
    }

    public function getFieldList(){
        return $this->model->select(['id','name','price','sale_price','status','created_at'])->orderBy('created_at','desc')->get();
    }
}