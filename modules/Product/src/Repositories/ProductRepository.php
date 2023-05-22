<?php

namespace Modules\Product\src\Repositories;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        // return Product::class;
    }
}