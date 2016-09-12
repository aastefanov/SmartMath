<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProblemRequest;
use App\Models\Category;
use App\Models\Problem;

class ProblemsController extends Controller
{

    //protected $baseUrl = 'admin/problems';

    public function store(StoreProblemRequest $request)
    {
        Problem::create($request->all());
        return "true";
    }

    public function createFromCategory($categoryId)
    {
        return view('admin.problems.add', ['category' => Category::findOrFail($categoryId)]);
    }

    public function show($id)
    {
        return Problem::findOrFail($id);
    }

    public function update($id, StoreProblemRequest $request)
    {
        Problem::findOrFail($id)->update($request->all());
        return "true";
    }

    public function destroy($id)
    {
        Problem::findOrFail($id)->delete();
        return "true";
    }
}