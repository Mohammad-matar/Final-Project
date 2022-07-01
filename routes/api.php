<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;





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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ADMINS ROUTE
Route::group(['prefix' => 'admins'], function () {
    Route::get('/', [AdminController::class, 'getadmin']);
    Route::get('/{id}', [AdminController::class, 'getById']);
    Route::post('/', [AdminController::class, 'create']);
    Route::post('/login', [AdminController::class, 'loginAdmin']);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::put('/{id}', [AdminController::class, 'update']);
    Route::delete('/{id}', [AdminController::class, 'delete']);
    // Route::post('/updateImage/{id}',[AdminController::class,'updateImage']);
});
//Category Route
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'getAll']);
    Route::get('/{id}', [CategoryController::class, 'getById']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
});

//Product Route
Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'getAll']);
    Route::get('/{id}', [ProductController::class, 'getById']);
    Route::get('/category/{id}',[ProductController::class,'getByCategory']);
    Route::post('/', [ProductController::class, 'create']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

//order Route
Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'getAll']);
    Route::get('/{id}', [OrderController::class, 'getById']);
    Route::post('/', [OrderController::class, 'create']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'delete']);
});
