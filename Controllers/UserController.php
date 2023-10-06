<?php

namespace Controllers;

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
        $name = request('name');
        $email = request('email');
        $password = request('password');

        $result = DB::query('insert into users (name, email, password) values (:name, :email, :password)', [
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        return $this->show($result->lastInsertId());
    }

    public function update($id)
    {
        $name = request('name');
        $email = request('email');
        $password = request('password');

        DB::query('UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id', [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
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
