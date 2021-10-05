<?php

namespace App\Service;

use App\Models\Question;

class QuestionCreator
{
    /** @var AnswersCreator */
    private $answersCreator;

    /** @codeCoverageIgnore */
    public function __construct(AnswersCreator $answersCreator)
    {
        $this->answersCreator = $answersCreator;
    }

    public function create($questionText, $correctAnswer, $wrongAnswers)
    {
        $question = Question::create([
            'text' => $questionText
        ]);

        $question->save();

        $this->answersCreator->create($question->id,
            $correctAnswer,
            $wrongAnswers
        );

        return $question;
    }
}
