<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubDepartmentController;


Route::get('/', function () {
    return view('Smile');
});

Route::resource('products', ProductController::class);
Route::resource('products', ProductController::class);

Route::resource('departments', DepartmentController::class);

Route::resource('sub-departments', SubDepartmentController::class);
Route::get('/get-subdepartments/{id}', [SubDepartmentController::class, 'get_sd']);

// });
