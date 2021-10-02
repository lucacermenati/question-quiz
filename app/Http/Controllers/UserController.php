<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Models\CustomUser;

class UserController extends Controller
{
    public function getUser()
    {
        return ;
    }

    public function getUsers()
    {
        return ;
    }

    public function createUser()
    {
        $user = CustomUser::create([
            'email' => 'lucacermenati.lc@gmail.com',
            'password' => 'luca',
            'roles' => [
                Roles::ROLE_MANAGER,
                Roles::ROLE_PLAYER
            ]
        ]);

        $user->save();
//        $user = new CustomUser();
//
//        $user->setEmail('lucacermenati.lc@gmail.com');
//        $user->setPassword('luca');
//        $user->setRoles([
//            Roles::ROLE_MANAGER,
//            Roles::ROLE_PLAYER,
//        ]);
//
//        $user->save();
//
//        return $user;
    }

    public function updateUser()
    {
        return;
    }
}
