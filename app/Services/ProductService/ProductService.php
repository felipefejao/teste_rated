<?php

namespace App\Services\ProductService;

use App\Models\Product;
use App\Repositories\ProductRepository\Contract\ProductRepositoryContract;
use App\Repositories\ProductRepository\ProductRepository;
use App\Services\ProductService\Contract\ProductServiceContract;

class ProductService implements ProductServiceContract
{
    private $productRepository;

    public function __construct(ProductRepositoryContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProduct(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->all();
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create([
            'description' => $data['description'],
            'quantity' => $data['quantity'],
        ]);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->productRepository->update($id,
            [
                'description' => $data['description'],
                'quantity' => $data['quantity'],
            ]
        );
    }

    public function removeProduct(int $id)
    {
        return $this->productRepository->delete($id);
    }
}
