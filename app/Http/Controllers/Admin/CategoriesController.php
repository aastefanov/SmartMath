<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', ['categories' => Category::all()]);
    }

    public function create() {
        return view('admin.categories.add');
    }

    public function store(Request $request) {
        dd($request);
    }

    public function show($id) {
        return view('admin.categories.view', ['category' => Category::findOrFail($id)]);
    }

    public function edit($id) {
        return view('admin.categories.edit', ['category' => Category::findOrFail($id)]);

    }

    public function update($id) {
        dd();
    }

    public function destroy($id) {
        dd();
    }
}