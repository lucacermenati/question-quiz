<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Service\ExceptionHandler;
use App\Service\GameCreator;
use App\Service\GameRetriever;
use App\Service\TokenValidator;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function createGame(
        TokenValidator $tokenValidator,
        GameCreator $gameCreator,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER,
                Roles::ROLE_PLAYER
            ]);


            $gameCreator->create($request->token);

            $this->setResponseSucceeded();
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function getGame(
        TokenValidator $tokenValidator,
        GameRetriever $gameRetriever,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER,
                Roles::ROLE_PLAYER
            ]);

            $this->setResponseSucceeded($gameRetriever->get($request->token));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }
}
