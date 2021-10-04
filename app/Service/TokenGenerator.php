<?php

namespace App\Service;

use App\Models\Token;

class TokenGenerator
{
    public function generate($role)
    {
        $token = Token::create([
            'token' => uniqid(),
            'role' => $role,
        ]);

        $token->save();

        return $token;
    }
}
