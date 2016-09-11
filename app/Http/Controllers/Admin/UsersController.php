<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function viewProfile($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}