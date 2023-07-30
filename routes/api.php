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
    Route::get('/{userId}', GetUserController::class)->name('api-get-user');
    Route::get('/', GetAllUsersController::class)->name('api-get-all-users');
    Route::post('/', AddUserController::class)->name('api-add-user');
    Route::post('/{userId}', UpdateUserController::class)->name('api-update-user');
    Route::delete('/{userId}', RemoveUserController::class)->name('api-remove-user');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/{productId}', GetProductController::class)->name('api-get-product');
    Route::get('/', GetAllProductsController::class)->name('api-get-all-products');
    Route::post('/', AddProductController::class)->name('api-add-product');
    Route::post('/{productId}', UpdateProductController::class)->name('api-update-product');
    Route::delete('/{productId}', RemoveProductController::class)->name('api-remove-product');
});
