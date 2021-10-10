<?php

namespace App\Service;

use App\Models\Answer;

class AnswerUpdater
{
    /** @var AnswersCreator */
    private $answersCreator;

    /** @codeCoverageIgnore */
    public function __construct(AnswersCreator $answersCreator)
    {
        $this->answersCreator = $answersCreator;
    }

    public function update($questionId, $correctAnswer, $wrongAnswers)
    {
        if ($correctAnswer) {
            $this->updateCorrectAnswer($questionId, $correctAnswer);
        }

        if (is_array($wrongAnswers)) {
            $this->updateWrongAnswers($questionId, $wrongAnswers);
        }
    }

    public function updateCorrectAnswer($questionId, $correctAnswer)
    {
        Answer::where([
            'question_id' => $questionId,
            'is_correct' => true,
        ])
        ->update([
            'text' => $correctAnswer
        ]);
    }

    public function updateWrongAnswers($questionId, $wrongAnswers)
    {
        Answer::where([
            'question_id' => $questionId,
            'is_correct' => false,
        ])->delete();

        $this->answersCreator->createWrong($questionId, $wrongAnswers);
    }
}
