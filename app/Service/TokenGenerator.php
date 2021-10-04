<?php

namespace App\Service;

use App\Models\Token;

class TokenGenerator
{
    public function generate()
    {
        $token = Token::create([
            'token' => uniqid()
        ]);

        $token->save();

        return $token;
    }
}
