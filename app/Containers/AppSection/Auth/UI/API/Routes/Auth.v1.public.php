<?php

use Illuminate\Support\Facades\Route;
use App\Containers\AppSection\Auth\UI\API\Controllers\RegisterManagerController;
use App\Containers\AppSection\Auth\UI\API\Controllers\CreateEmployeeController;
use App\Containers\AppSection\Auth\UI\API\Controllers\LoginController;

Route::post('register', RegisterManagerController::class);
Route::post('login', LoginController::class);