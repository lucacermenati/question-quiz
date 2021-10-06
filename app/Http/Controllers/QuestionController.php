<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Http\Resources\QuestionCollectionResource;
use App\Service\ExceptionHandler;
use App\Service\QuestionCollectionBeautifier;
use App\Service\QuestionCreator;
use App\Service\QuestionRequestValidator;
use App\Service\QuestionRetriever;
use App\Service\QuestionUpdater;
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
        QuestionCollectionBeautifier $questionCollectionBeautifier,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER
            ]);

            $questions = $questionRetriever->getAllWithAnswers();

            $this->setResponseSucceeded($questionCollectionBeautifier->beautify($questions));
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }

    public function updateQuestion(
        TokenValidator $tokenValidator,
        QuestionUpdater $questionUpdater,
        Request $request,
        ExceptionHandler $exceptionHandler
    ) {
        try {
            $tokenValidator->validate($request->token, [
                Roles::ROLE_ADMIN,
                Roles::ROLE_MANAGER
            ]);

            $this->setResponseSucceeded($questionUpdater->update(
                $request->id,
                $request->question,
                $request->correctAnswer,
                $request->wrongAnswers
            ));
        } catch (\Exception $exception) {
            $this->setResponseFailed(...$exceptionHandler->handle(
                $exception
            ));
        }

        return $this->response;
    }
}
