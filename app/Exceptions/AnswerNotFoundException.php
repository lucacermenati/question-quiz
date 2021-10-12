<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class AnswerNotFoundException extends ApiException
{

    protected $messageFormat = "Answer not found: answer with id [%s] doesn't belong to question [%s]";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;

    /** @codeCoverageIgnore */
    public function __construct($id, $questionId)
    {
        $this->message = sprintf($this->messageFormat, $questionId, $id);
    }
}
