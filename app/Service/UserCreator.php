<?php

namespace App\Service;

use App\Models\CustomUser;

class UserCreator
{
    public function create($email, $password, $role)
    {
        $user = CustomUser::create([
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);

        $user->save();

        return $user;
    }
}
