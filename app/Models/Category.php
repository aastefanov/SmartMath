<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function problems()
    {
        return $this->hasMany('App\Models\Problem');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}