<?php

use App\Containers\AppSection\User\UI\API\Controllers\CreateEmployeeController;
use Illuminate\Support\Facades\Route;

Route::post('employees', CreateEmployeeController::class)->middleware(['auth:api']); 