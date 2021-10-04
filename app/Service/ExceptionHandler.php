<?php

namespace App\Service;

use App\Enum\HttpStatusCode;
use App\Exceptions\ApiException;

class ExceptionHandler
{
    public function handle(\Exception $exception)
    {
        if ($exception instanceof ApiException) {
            return [
                $exception->getMessage(),
                $exception->getStatusCode(),
            ];
        }

        return [
            `An unexpected error has occurred. : ${$exception->getMessage()}`,
            HttpStatusCode::BAD_REQUEST,
        ];
    }
}
