<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }
}