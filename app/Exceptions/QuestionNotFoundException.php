<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class QuestionNotFoundException extends ApiException
{

    protected $messageFormat = "Question not found: question with id [%s] doesn't exist";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;

    /** @codeCoverageIgnore */
    public function __construct($id)
    {
        $this->message = sprintf($this->messageFormat, $id);
    }
}
