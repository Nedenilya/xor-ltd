<?php

use Illuminate\Support\Facades\Route;
use App\Containers\AppSection\Post\UI\API\Controllers\PostController;

Route::middleware(['auth:api'])->group(function () {
    Route::get('posts', [PostController::class, 'list']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
    Route::get('posts/category/{categoryId}', [PostController::class, 'showByCategory']);
    Route::get('posts/employee/{employeeId}', [PostController::class, 'showByEmployee']);
}); 