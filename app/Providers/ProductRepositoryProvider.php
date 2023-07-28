<?php

namespace App\Providers;

use App\Repositories\ProductRepository\Contract\ProductRepositoryContract;
use App\Repositories\ProductRepository\ProductRepository;
use App\Services\ProductService\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryContract::class, ProductRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function provides(): array
    {
        return [ProductRepositoryContract::class];
    }
}
