<?php

use App\Http\Api\Controllers\Accounts\AddProductToSubAccountController;
use App\Http\Api\Controllers\Accounts\CreateSubAccountController;
use App\Http\Api\Controllers\Auth\LoginController;
use App\Http\Api\Controllers\Accounts\GetSubAccountsController;
use App\Http\Api\Controllers\Accounts\UpdateDetailQuantityController;
use App\Http\Api\Controllers\Categories\CreateCategoryController;
use App\Http\Api\Controllers\Categories\GetCategoriesController;
use App\Http\Api\Controllers\Categories\UpdateCategoryController;
use App\Http\Api\Controllers\Products\CreateProductController;
use App\Http\Api\Controllers\Products\DeleteCategoryController;
use App\Http\Api\Controllers\Products\DeleteProductController;
use App\Http\Api\Controllers\Products\UpdateProductController;
use App\Http\Api\Controllers\Tables\GetTablesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->middleware([])->group(function (): void {
    Route::post('/login', [LoginController::class, '__invoke'])->name('auth.login');
});

Route::prefix('tables')->middleware(['jwt'])->group(function (): void {
    Route::get('/', [GetTablesController::class, '__invoke'])->name('tables');
    Route::post('/sub-accounts', [CreateSubAccountController::class, '__invoke'])->name('create-sub-accounts');
    Route::post('/sub-accounts/{id}/products', [AddProductToSubAccountController::class, '__invoke'])->name('add-product-to-sub-accounts');
    Route::get('/sub-accounts/{id}', [GetSubAccountsController::class, '__invoke'])->name('sub-accounts');
    Route::put('/sub-accounts/{id}/detail/{detailId}', [UpdateDetailQuantityController::class, '__invoke'])->name('edit-detail-quantity');
});

Route::prefix('products')->middleware(['jwt'])->group(function (): void {
    Route::get('/', [GetCategoriesController::class, '__invoke'])->name('get-categories-with-products');
    Route::post('/categories', [CreateCategoryController::class, '__invoke'])->name('create-category');
    Route::put('/categories/{id}', [UpdateCategoryController::class, '__invoke'])->name('update-category');
    Route::delete('/categories/{id}', [DeleteCategoryController::class, '__invoke'])->name('delete-category');
});

Route::prefix('products')->middleware(['jwt'])->group(function (): void {
    Route::post('/', [CreateProductController::class, '__invoke'])->name('create-product');
    Route::put('/{id}', [UpdateProductController::class, '__invoke'])->name('update-product');
    Route::delete('/{id}', [DeleteProductController::class, '__invoke'])->name('delete-product');
});
