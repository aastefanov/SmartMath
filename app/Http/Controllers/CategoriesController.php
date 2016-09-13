<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function getPreferredProblem($categoryId)
    {
        $category = Category::findOrFail($categoryId);

	$problem = $category->preferredProblems(Auth::user())->first();

	return $problem;
    }

    public function getProblem($categoryId) {
	$problem = $this->getPreferredProblem($categoryId);
	return view('problems.solve', ['problem' => $problem]);
    }
}
