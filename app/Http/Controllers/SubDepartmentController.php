<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{
    public function index()
    {
        $data = SubDepartment::with('department')->get();
        return view('sub_departments.index', compact('data'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('sub_departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required'
        ]);

        SubDepartment::create($request->only('department_id', 'name'));

        return redirect()->route('sub-departments.index')->with('success', 'Created!');
    }

    public function edit(SubDepartment $subDepartment)
    {
        $departments = Department::all();
        return view('sub_departments.edit', compact('subDepartment', 'departments'));
    }

    public function update(Request $request, SubDepartment $subDepartment)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required'
        ]);

        $subDepartment->update($request->only('department_id', 'name'));

        return redirect()->route('sub-departments.index')->with('success', 'Updated!');
    }

    public function destroy(SubDepartment $subDepartment)
    {
        $subDepartment->delete();

        return redirect()->route('sub-departments.index')->with('success', 'Deleted!');
    }
}
