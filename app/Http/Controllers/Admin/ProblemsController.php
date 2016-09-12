<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProblemRequest;
use App\Models\Problem;

class ProblemsController extends Controller
{

    protected $baseUrl = 'admin/problems';

    public function index()
    {
        return view('admin.problems.index', ['problems' => Problem::all()]);
    }

    public function create()
    {
        return view('admin.problems.add');
    }

    public function store(StoreProblemRequest $request)
    {
        Problem::create($request->all());
        redirect($this->baseUrl)->with(['status' => 'problem successfully created']);
        return "true";
    }

    public function show($id)
    {
        return view('admin.problems.edit', ['problem' => Problem::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('admin.problems.edit', ['problem' => Problem::findOrFail($id)]);
    }

    public function update($id, StoreProblemRequest $request)
    {
        Problem::findOrFail($id)->update($request->all());
        redirect($this->baseUrl)->with(['status' => 'problem successfully updated']);
        return "true";
    }

    public function destroy($id)
    {
        Problem::findOrFail($id)->delete();
        redirect($this->baseUrl)->with(['status' => 'problem successfully deleted']);
        return "true";
    }
}