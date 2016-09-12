<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token', 'is_admin'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function problems()
    {
        return $this->hasMany('App\Models\Problem');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function isAdmin()
    {
        return (bool)$this->is_admin;
    }
}
