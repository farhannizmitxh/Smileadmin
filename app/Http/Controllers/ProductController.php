<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Department;
use App\Models\SubDepartment;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $departments = Department::all();
        $subdepartments = SubDepartment::all();
        return view('products.index', compact('products', 'departments', 'subdepartments'));
    }

    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'nullable|string',
            'main_category' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'sub_department_id' => 'required|exists:sub_departments,id',
        ]);

        Product::create($validated);
        return back();
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back();
    }
}