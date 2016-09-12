<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token', 'is_admin'];

    protected $dates = ['created_at', 'updated_at'];

    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem')->withPivot('is_correct');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withPivot('difficulty');
    }

    public function isAdmin()
    {
        return (bool)$this->is_admin;
    }
}
