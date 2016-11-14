<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Problem;

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

	public function solve($problemId, Request $request) {
		//$correct = (bool)($request->input('correct', false));
		$correct = false;
		$problem = Problem::findOrFail($problemId);
		$category = $problem->category()->get()->first();
		$user = Auth::user();

		if(!$user->problems->contains($problem)) {
			$user->problems()->attach($problem,
				['is_correct' => $correct]
			);
		}

		$userCategory = $user->categories()->where('category_id', $category->id)->get()->first();
		if($correct) {

			$userCategory->difficulty += 1;
		}
		else {
			$userCategory->difficulty -= 1;
		}
	}
}
