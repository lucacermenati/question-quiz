<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Service\ExceptionHandler;
use App\Service\TokenValidator;
use App\Service\UserCreator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser()
    {
        return;
    }

    public function getUsers()
    {
        return;
    }

    public function createUser(
        TokenValidator $tokenValidator,
        UserCreator $userCreator,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN
            ]);

            $this->setResponseSucceeded($userCreator->create(
                $request->email,
                $request->password,
                $request->role
            ));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function updateUser()
    {
        return;
    }
}
