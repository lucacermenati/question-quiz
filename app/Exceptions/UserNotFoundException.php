<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class UserNotFoundException extends ApiException
{
    protected $message = "User not found: invalid email or password";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;
}
