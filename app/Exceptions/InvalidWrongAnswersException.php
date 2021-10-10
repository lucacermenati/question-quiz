<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class InvalidWrongAnswersException extends ApiException
{
    protected $message = "Invalid or missing parameter 'wrong_answers': Creating a question you must assign an array of wrong_answers to it";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;
}
