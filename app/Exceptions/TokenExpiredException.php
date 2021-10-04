<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class TokenExpiredException extends ApiException
{
    protected $message = "Token expired";
    protected $statusCode = HttpStatusCode::UNAUTHORIZED;
}
