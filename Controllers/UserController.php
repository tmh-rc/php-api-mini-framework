<?php

namespace Controllers;

use Core\Validator;
use Core\Facades\DB;

class UserController
{
    public function index()
    {
        $users = DB::query('select * from users')->get();

        return response()->json([
            'data' => $users,
        ]);
    }

    public function show($id)
    {
        $user = DB::query('select * from users where id=:id', [
            'id' => $id,
        ])->first();

        return response()->json([
            'data' => $user,
        ]);
    }

    public function store()
    {
        $data = request()->all();

        Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ])->validate();

        $result = DB::query('insert into users (name, email, password) values (:name, :email, :password)', [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $this->show($result->lastInsertId());
    }

    public function update($id)
    {
        $data = request()->all();

        Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $id . ',id'],
            'password' => ['required'],
        ])->validate();

        DB::query('UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id', [
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $this->show($id);
    }

    public function destroy($id)
    {
        DB::query('delete from users WHERE id=:id', [
            'id' => $id,
        ]);

        return response()->json([], 200);
    }
}
