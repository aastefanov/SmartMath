<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CategoriesController extends Controller
{

    protected $baseUrl = 'admin/categories';

    public function index()
    {
        return view('admin.categories.index', ['categories' => Category::all()]);
    }

    public function create()
    {
        return view('admin.categories.add');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());
        redirect($this->baseUrl)->with(['status' => 'Category successfully created']);
        return "true";
    }

    public function show($id)
    {
        return view('admin.categories.edit', ['category' => Category::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('admin.categories.edit', ['category' => Category::findOrFail($id)]);
    }

    public function update($id, StoreCategoryRequest $request)
    {
        Category::findOrFail($id)->update($request->all());
        redirect($this->baseUrl)->with(['status' => 'Category successfully updated']);
        return "true";
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        redirect($this->baseUrl)->with(['status' => 'Category successfully deleted']);
        return "true";
    }
}