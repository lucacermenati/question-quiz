<?php

namespace App\Service;

use App\Models\CustomUser;
use App\Models\Token;

class Authenticator
{
    public function authenticate($email, $password)
    {
        $user = CustomUser::where('email', "=", $email)->first();

        if(!$user) {
            throw new \Exception("Users not found");
        }

        $user->token = $this->generateToken();
        $user->save();

        return $user;
    }

    public function generateToken()
    {
        $token = Token::create([
            'token' => uniqid()
        ]);

        $token->save();

        return $token;
    }
}
