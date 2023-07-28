<?php

namespace App\Repositories\ProductRepository;

use App\Models\Product;
use App\Repositories\BaseRepository\BaseRepository;
use App\Repositories\ProductRepository\Contract\ProductRepositoryContract;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
