<?php

namespace App\Service;

use App\Exceptions\InvalidWrongAnswersException;
use App\Exceptions\MissingCorrectAnswerException;
use App\Exceptions\MissingQuestionException;
use App\Exceptions\QuestionNotFoundException;
use App\Models\Question;

class QuestionRequestValidator
{
    /**
     * @param $request
     * @throws InvalidWrongAnswersException
     * @throws MissingCorrectAnswerException
     * @throws MissingQuestionException
     */
    public function validateCreation($request)
    {
        $this->validateQuestion($request->question);
        $this->validateCorrectAnswer($request->correct_answer);
        $this->validateWrongAnswers($request->wrong_answers);
    }

    /**
     * @param $request
     * @throws QuestionNotFoundException
     */
    public function validateUpdate($request)
    {
        $this->validateQuestionExists($request->id);
    }

    /**
     * @param $question
     * @throws MissingQuestionException
     */
    public function validateQuestion($question)
    {
        if(!$question) {
            throw new MissingQuestionException();
        }
    }

    /**
     * @param $correctAnswer
     * @throws MissingCorrectAnswerException
     */
    public function validateCorrectAnswer($correctAnswer)
    {
        if(!$correctAnswer) {
            throw new MissingCorrectAnswerException();
        }
    }

    /**
     * @param $wrongAnswers
     * @throws InvalidWrongAnswersException
     */
    public function validateWrongAnswers($wrongAnswers)
    {
        if(!$wrongAnswers || !is_array($wrongAnswers)) {
            throw new InvalidWrongAnswersException();
        }
    }

    public function validateQuestionExists($id)
    {
       $question = Question::where([
           'id' => $id
       ])->first();

       if(!$question) {
           throw new QuestionNotFoundException($id);
       }
    }
}
