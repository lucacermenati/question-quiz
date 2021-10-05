<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Service\ExceptionHandler;
use App\Service\QuestionCreator;
use App\Service\QuestionRequestValidator;
use App\Service\QuestionRetriever;
use App\Service\TokenValidator;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function createQuestion(
        TokenValidator $tokenValidator,
        QuestionRequestValidator $questionRequestValidator,
        QuestionCreator $questionCreator,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER
            ]);

            $questionRequestValidator->validate($request);

            $question = $questionCreator->create(
                $request->question,
                $request->correctAnswer,
                $request->wrongAnswers
            );

            $this->setResponseSucceeded($question->setAnswers());
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function listQuestions(
        TokenValidator $tokenValidator,
        QuestionRetriever $questionRetriever,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER
            ]);

            $this->setResponseSucceeded($questionRetriever->getAll());
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
