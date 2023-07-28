<?php

namespace App\Providers;

use App\Services\ProductService\Contract\ProductServiceContract;
use App\Services\ProductService\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductServiceContract::class,
            ProductService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function provides(): array
    {
        return [ProductServiceContract::class];
    }
}
