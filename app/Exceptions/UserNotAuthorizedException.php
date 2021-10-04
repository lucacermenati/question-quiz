<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class UserNotAuthorizedException extends ApiException
{
    protected $message = "Unauthorized";
    protected $statusCode = HttpStatusCode::UNAUTHORIZED;
}
