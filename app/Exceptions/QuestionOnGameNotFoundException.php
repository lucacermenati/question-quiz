<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class QuestionOnGameNotFoundException extends ApiException
{

    protected $messageFormat = "Question not found: question with id [%s] is not associated to this game.";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;

    /** @codeCoverageIgnore */
    public function __construct($id)
    {
        $this->message = sprintf($this->messageFormat, $id);
    }
}
