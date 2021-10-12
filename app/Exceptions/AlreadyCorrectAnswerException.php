<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class AlreadyCorrectAnswerException extends ApiException
{
    protected $message = "You can't answer an already correct question";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;
}
