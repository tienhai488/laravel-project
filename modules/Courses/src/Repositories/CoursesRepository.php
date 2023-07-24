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
}