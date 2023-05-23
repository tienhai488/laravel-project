<?php

namespace Modules\Dashboard\src\Repositories;
use App\Repositories\BaseRepository;

class DashboardRepository extends BaseRepository implements DashboardRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        // return Dashboard::class;
    }
}