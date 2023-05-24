<?php

namespace Modules\User\src\Repositories;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUser($limit = 10); //lấy số lượng tùy ý

    public function getFieldList();
}