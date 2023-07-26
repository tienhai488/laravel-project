<?php

namespace Modules\Teachers\src\Repositories;
use App\Repositories\BaseRepository;
use Modules\Teachers\src\Models\Teachers;

class TeachersRepository extends BaseRepository implements TeachersRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Teachers::class;
    }

    public function getFieldList(){
        return $this->model->select(['id','name','slug','exp','image','created_at'])->orderBy('created_at','desc')->get();
    }
}