<?php

namespace App\Service;

use App\Models\Question;

class QuestionUpdater
{
    /** @var AnswerUpdater */
    private $answerUpdater;

    /** @codeCoverageIgnore */
    public function __construct(AnswerUpdater $answerUpdater)
    {
        $this->answerUpdater = $answerUpdater;
    }

    public function update($questionId, $questionText, $correctAnswer, $wrongAnswers)
    {
        $updates = [];

        if($questionText) {
            $updates['text'] = $questionText;
        }

        Question::where([
            'id' => $questionId
        ])
        ->update($updates);

        $this->answerUpdater->update($questionId, $correctAnswer, $wrongAnswers);

        return ;
    }
}
