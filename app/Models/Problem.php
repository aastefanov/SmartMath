<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'answer', 'difficulty'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}