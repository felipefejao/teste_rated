<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Services\ProductService\Contract\ProductServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UpdateProductController extends Controller
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
        $validator = Validator::make($request->all(), [
            'description' =>'required',
            'quantity' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $updated = $this->productService->updateProduct($productId, $validator->valid());
            if (! $updated) {
                return response()->json(['message' => 'Could not update product'], 500);
            }

            return response()->json([
                'message' => 'Updated successfully'
            ], 201);
        } catch (Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage()
            ], 400);
        }
    }
}
