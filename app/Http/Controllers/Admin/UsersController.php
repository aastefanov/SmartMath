<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\User;

class UsersController extends Controller
{

    protected $baseUrl = 'admin/users';

    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'is_admin' => $request['is_admin'] ? true : false
        ]);

        return redirect($this->baseUrl)->with(['status' => 'User successfully created']);
    }

    public function show($id)
    {
        return view('admin.users.edit', ['user' => User::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('admin.users.edit', ['user' => User::findOrFail($id)]);
    }

    public function update($id, StoreUserRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        if (isset($request['password'])) {
            $user->update(['password' => bcrypt($request['password'])]);
        }

        $user->is_admin = $request['is_admin'] ? true : false;

        $user->save();
        return redirect($this->baseUrl)->with(['status' => 'User successfully updated']);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        redirect($this->baseUrl)->with(['status' => 'User successfully deleted']);
        return "true";
    }
}