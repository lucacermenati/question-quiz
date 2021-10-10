<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class MissingQuestionException extends ApiException
{
    protected $message = "Missing mandatory parameter 'question': Creating a question you must assign a text to it";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;
}
