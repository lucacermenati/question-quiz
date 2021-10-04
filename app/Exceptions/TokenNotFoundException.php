<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class TokenNotFoundException extends ApiException
{
    protected $message = "Token not found";
    protected $statusCode = HttpStatusCode::UNAUTHORIZED;
}
