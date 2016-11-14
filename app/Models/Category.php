<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'description'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function problems()
	{
		return $this->hasMany('App\Models\Problem');
	}

	public function users()
	{
		return $this->belongsToMany('App\User')->withPivot('difficulty');
	}

	public function preferredProblems(User $user)
	{

		if (!$this->users->contains($this)) {
			$this->users()->attach($user, ['difficulty' => 3]);
		}

		$userCategory = $user->categories()->where('category_id', $this->id)->get()->first();
		$userDifficulty = $userCategory->pivot->difficulty;

		$problems = $this->problems()->where('category_id', $this->id)->get()->keyBy('id');

		$userProblems = $user->problems()->get();
		foreach($problems as $problem) {
			if($problem->difficulty < $userDifficulty) {
				$problems->forget($problem->id);
				continue;
			}

			if($userProblems->contains($problem)) {
				$problems->forget($problem->id);
			}
		}
		return $problems;
	}
}
