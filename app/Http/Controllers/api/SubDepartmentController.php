<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubDepartment;

class SubDepartmentController extends Controller
{
    public function index()
    {
        return SubDepartment::with('department')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required'
        ]);

        $sub = SubDepartment::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
        ]);

        return $sub;
    }

    public function show(string $id)
    {
        return SubDepartment::with('department')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required'
        ]);

        $sub = SubDepartment::findOrFail($id);

        $sub->update([
            'department_id' => $request->department_id,
            'name' => $request->name
        ]);

        return $sub;
    }

    public function destroy(string $id)
    {
        $sub = SubDepartment::findOrFail($id);
        $sub->delete();

        return ['message' => 'Sub department deleted'];
    }

    public function getByDepartment($id)
    {
        return SubDepartment::where('department_id', $id)->get();
    }
}
