<?php

use App\Http\Api\Controllers\Auth\LoginController;
use App\Http\Api\Controllers\Accounts\GetSubAccountsController;
use App\Http\Api\Controllers\Accounts\UpdateDetailQuantityController;
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
    Route::get('/sub-accounts/{id}', [GetSubAccountsController::class, '__invoke'])->name('sub-accounts');
    Route::put('/sub-accounts/{id}/detail/{detailId}', [UpdateDetailQuantityController::class, '__invoke'])->name('edit-detail-quantity');
});
