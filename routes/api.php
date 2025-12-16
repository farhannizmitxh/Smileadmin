<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\SubDepartmentController;

// Products
Route::get('/products', [ProductController::class, 'index']);

Route::get('/departments', [DepartmentController::class, 'index']);


// Sub Departments CRUD
Route::get('/sub-departments/department/{id}', [SubDepartmentController::class, 'getByDepartment']);

// Get SubDepartments by Department ID
Route::get('/departments/{id}/sub', [SubDepartmentController::class, 'byDepartment']);
