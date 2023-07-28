<?php

namespace App\Services\ProductService\Contract;

interface ProductServiceContract
{
    public function getProduct(int $id);

    public function getAllProducts();

    public function createProduct(array $data);

    public function updateProduct(int $id, array $data);

    public function removeProduct(int $id);
}
