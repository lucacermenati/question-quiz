<?php

namespace App\Service;

use App\Models\Token;

class TokenValidator
{
    public function validate($tokenValue, $validRoles)
    {
        $this->validateExpiration($tokenValue);
        $this->validateRoles($tokenValue, $validRoles);
    }

    public function validateExpiration()
    {
        //TODO complete
        return;
    }

    public function validateRoles($tokenValue, $validRoles)
    {
        //TODO complete
        return;
    }
}
