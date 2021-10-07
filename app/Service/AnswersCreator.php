<?php

namespace App\Service;

use App\Models\Answer;

class AnswersCreator
{
    public function create($questionId, $correctAnswer, $wrongAnswers)
    {
        $this->createCorrect($questionId, $correctAnswer);
        $this->createWrong($questionId, $wrongAnswers);
    }

    public function createCorrect($questionId, $correctAnswer)
    {
        $answer = Answer::create([
            'question_id' => $questionId,
            'text' => $correctAnswer,
            'is_correct' => true
        ]);

        $answer->save();
    }

    public function createWrong($questionId, $wrongAnswers)
    {
        foreach ($wrongAnswers as $wrongAnswer) {
            $answer = Answer::create([
                'question_id' => $questionId,
                'text' => $wrongAnswer,
                'is_correct' => false
            ]);

            $answer->save(); //TODO: look for a bulk insert
        }
    }
}
