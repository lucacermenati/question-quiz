<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Service\ExceptionHandler;
use App\Service\TokenValidator;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function listAllQuestions()
    {
        return;
    }

    public function createQuestion(
        TokenValidator $tokenValidator,
        QuestionCreator $questionCreator,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER
            ]);

            $this->setResponseSucceeded($questionCreator->create(

            ));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function updateQuestion()
    {
        return;
    }
}
