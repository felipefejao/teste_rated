<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Services\ProductService\Contract\ProductServiceContract;
use App\Services\ProductService\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AddProductController extends Controller
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
        $validator = Validator::make($request->all(), [
            'description' =>'required',
            'quantity' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $inserted = $this->productService->createProduct($validator->valid());
            if (! $inserted) {
                return response()->json([
                  'message' => 'Could not create product'
                ], 500);
            }

            return response()->json([
                'message' => 'Product created successfully!'
            ], 201);
        } catch (Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage()
            ], $throwable->getCode());
        }
    }
}
