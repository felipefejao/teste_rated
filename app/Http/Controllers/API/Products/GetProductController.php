<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Services\ProductService\Contract\ProductServiceContract;
use App\Services\ProductService\ProductService;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class GetProductController extends Controller
{
    private $productService;

    public function __construct(ProductServiceContract $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $productId)
    {
        try {
            $product = $this->productService->getProduct($productId);
            if (! $product) {
                throw new Exception("Product Not Found", 404);
            }

            return response()->json($product);

        } catch (Throwable $throwable) {
            return response()->json([
                'errorMessage' => $throwable->getMessage()
            ], $throwable->getCode());
        }
    }
}
