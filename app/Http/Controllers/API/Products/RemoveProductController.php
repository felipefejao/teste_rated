<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Services\ProductService\Contract\ProductServiceContract;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class RemoveProductController extends Controller
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
            $user = $this->productService->getProduct($productId);
            if (!$user) {
                throw new Exception("Id Not Found", 404);
            }

            $remove = $this->productService->removeProduct($productId);
            if (! $remove) {
                throw new Exception("Something went wrong", 500);
            }

            return response()->json([
                'message' => 'User Removed Successfully'
            ], 200);

        } catch (Throwable $throwable) {
            return response()->json([
                'errorCode' => $throwable->getCode(),
                'message' => $throwable->getMessage()
            ],$throwable->getCode());
        }
    }
}
