<?php

namespace App\Service;

use App\Exceptions\MissingTokenException;
use App\Exceptions\TokenNotFoundException;
use App\Exceptions\UserNotAuthorizedException;
use App\Models\Token;

class TokenValidator
{
    public function validate($tokenValue, $validRoles)
    {
        $this->validateTokenValue($tokenValue);

        $token = Token::where([
            'token' => $tokenValue,
        ])->first();

        $this->validateToken($token);
        $this->validateRole($token->role, $validRoles);
    }

    public function validateTokenValue($tokenValue)
    {
        if(!$tokenValue) {
            throw new MissingTokenException();
        }
    }

    public function validateToken($token)
    {
        if(!$token) {
            throw new TokenNotFoundException();
        }
    }

    public function validateRole($role, $validRoles)
    {
        if(!in_array($role, $validRoles)) {
            throw new UserNotAuthorizedException();
        }
    }
}
