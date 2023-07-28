<?php

use App\Http\Controllers\API\Products\AddProductController;
use App\Http\Controllers\API\Products\GetAllProductsController;
use App\Http\Controllers\API\Products\GetProductController;
use App\Http\Controllers\API\Products\RemoveProductController;
use App\Http\Controllers\API\Products\UpdateProductController;
use App\Http\Controllers\API\Users\AddUserController;
use App\Http\Controllers\API\Users\GetAllUsersController;
use App\Http\Controllers\API\Users\GetUserController;
use App\Http\Controllers\API\Users\RemoveUserController;
use App\Http\Controllers\API\Users\UpdateUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'user'], function () {
    Route::get('/{userId}', GetUserController::class);
    Route::get('/', GetAllUsersController::class);
    Route::post('/', AddUserController::class);
    Route::post('/{userId}', UpdateUserController::class);
    Route::delete('/{userId}', RemoveUserController::class);
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/{productId}', GetProductController::class);
    Route::get('/', GetAllProductsController::class);
    Route::post('/', AddProductController::class);
    Route::post('/{productId}', UpdateProductController::class);
    Route::delete('/{productId}', RemoveProductController::class);
});
