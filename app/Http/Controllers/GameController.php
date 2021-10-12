<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Service\ExceptionHandler;
use App\Service\GameCreator;
use App\Service\GameManager;
use App\Service\GameRequestValidator;
use App\Service\GameRetriever;
use App\Service\StatsCalculator;
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

            $this->setResponseSucceeded([
                "game_id" => $gameCreator->create($request->token)
            ]);
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function getGame(
        TokenValidator $tokenValidator,
        GameRequestValidator $gameRequestValidator,
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

            $gameRequestValidator->validate($request);

            $this->setResponseSucceeded($gameRetriever->get(
                $request->token,
                $request->game_id
            ));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function playGame(
        TokenValidator $tokenValidator,
        GameRequestValidator $gameRequestValidator,
        GameManager $gameManager,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER,
                Roles::ROLE_PLAYER
            ]);

            $gameRequestValidator->validatePlay($request);

            $this->setResponseSucceeded($gameManager->play(
                $request->token,
                $request->game_id,
                $request->question_id,
                $request->answer_id
            ));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function resetGame(
        TokenValidator $tokenValidator,
        GameRequestValidator $gameRequestValidator,
        GameManager $gameManager,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER,
            ]);

            $gameRequestValidator->validateGameExists($request);

            $this->setResponseSucceeded($gameManager->reset(
                $request->game_id
            ));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function getStats(
        TokenValidator $tokenValidator,
        GameRequestValidator $gameRequestValidator,
        StatsCalculator $statsCalculator,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER,
                Roles::ROLE_PLAYER,
            ]);

            $gameRequestValidator->validate($request);

            $token = $request->token;
            $gameId = $request->game_id;

            $this->setResponseSucceeded([
                "total" => $statsCalculator->calculateTotalQuestions($token, $gameId),
                "percentage_answered" => $statsCalculator->calculateAnsweredQuestions($token, $gameId),
                "percentage_correct" => $statsCalculator->calculateCorrectQuestions($token, $gameId),
            ]);
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }
}
