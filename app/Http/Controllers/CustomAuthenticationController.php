<?php

namespace App\Http\Controllers;

use App\Service\Authenticator;
use App\Service\ExceptionHandler;
use Illuminate\Http\Request;

class CustomAuthenticationController extends Controller
{
    public function getToken(Request $request, ExceptionHandler $exceptionHandler, Authenticator $authenticator)
    {
        try {
            $this->setResponseSucceeded($authenticator->authenticate(
                $request->email,
                $request->password
            ));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }
}
