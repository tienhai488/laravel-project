<?php

namespace Modules\Categories\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Category::class;
    }
}