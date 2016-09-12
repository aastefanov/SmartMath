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
        $problems = $this->problems()->get();
        $userProblems = $this->problems()->with('category')->where('category_id', $this->id);

        if (!$this->users->contains($this)) {
            $this->users()->attach($user, ['difficulty' => 3]);
        }

        $userCategory = $user->categories()->find($this);

        return $problems->sort(function ($a, $b) use ($userProblems, $userCategory) {
            if ($a->difficulty < $userCategory->difficulty || $b->difficulty < $userCategory->difficulty) {
                return -1;
            }

            $problemASolved = $userProblems->contains($a);
            $problemBSolved = $userProblems->contains($b);

            $problemACorrect = $problemASolved ? $userProblems->find($a)->is_correct : false;
            $problemBCorrect = $problemBSolved ? $userProblems->find($b)->is_correct : false;

            $priorityA = -12 * ($a->difficulty - $userCategory->difficulty) + 5 * $problemASolved + 3 * $problemACorrect;
            $priorityB = -12 * ($b->difficulty - $userCategory->difficulty) + 5 * $problemBSolved + 3 * $problemBCorrect;

            if ($priorityA == $priorityB) return 0;

            return ($priorityA < $priorityB) ? 1 : -1;
        });
    }
}