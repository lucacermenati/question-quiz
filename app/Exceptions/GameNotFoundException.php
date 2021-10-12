<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCode;

class GameNotFoundException extends ApiException
{

    protected $messageFormat = "Game not found: game with id [%s] doesn't exist in your list of created games";
    protected $statusCode = HttpStatusCode::BAD_REQUEST;

    /** @codeCoverageIgnore */
    public function __construct($id)
    {
        $this->message = sprintf($this->messageFormat, $id);
    }
}
