<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class MissingCorrectAnswerException extends ApiException
{
    protected $message = "Missing mandatory parameter 'correct_answer': Creating a question you must assign a correct answer to it";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;
}
