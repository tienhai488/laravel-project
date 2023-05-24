<?php

namespace Modules\User\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\User\src\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return User::class;
    }
    public function getUser($limit = 10)
    {
        return $this->model->limit($limit)->get();
    }

    public function getFieldList(){
        return $this->model->select(['id','name','email','group_id','created_at'])->orderBy('created_at','desc')->get();
    }
}