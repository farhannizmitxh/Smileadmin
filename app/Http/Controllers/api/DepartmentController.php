<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Ambil semua department
    public function index()
    {
        return response()->json(Department::all());
    }

    // Ambil subkategori berdasarkan department (opsional)
    public function subdepartments($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department->subdepartments ?? []);
    }
}
