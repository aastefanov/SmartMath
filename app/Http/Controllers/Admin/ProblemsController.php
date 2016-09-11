<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Problem;

class ProblemsController extends Controller
{
    public function index()
    {
        return view('admin.problems.index', ['problems' => Problem::all()]);
    }
}