<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Services\ProductService\Contract\ProductServiceContract;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class GetAllProductsController extends Controller
{
    private $productService;

    public function __construct(ProductServiceContract $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $product = $this->productService->getAllProducts();
            if (! $product) {
                throw new Exception("Products Not Found", 404);
            }

            return response()->json($product);

        } catch (Throwable $throwable) {
            return response()->json([
                'errorMessage' => $throwable->getMessage()
            ], $throwable->getCode());
        }
    }
}
