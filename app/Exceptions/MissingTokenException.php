<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class MissingTokenException extends ApiException
{
    protected $message = "Missing token";
    protected $statusCode = HttpStatusCode::UNAUTHORIZED;
}
