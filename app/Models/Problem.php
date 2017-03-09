<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem extends Model
{
	use SoftDeletes;

	protected $fillable = ['description', 'answer', 'category_id', 'difficulty'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function users()
	{
		return $this->belongsToMany('App\User')->withPivot('is_correct');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}

	public function hint()
	{
		return $this->hasMany('App\Models\Hint');
	}
}
