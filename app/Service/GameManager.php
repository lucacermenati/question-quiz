<?php

namespace App\Service;

use App\Enum\QuestionStatus;
use App\Models\Answer;
use App\Models\Game;

class GameManager
{
    /** @var GameRetriever */
    private $gameRetriever;

    /** @codeCoverageIgnore */
    public function __construct(GameRetriever $gameRetriever)
    {
        $this->gameRetriever = $gameRetriever;
    }

    public function play($token, $gameId, $questionId, $answerId)
    {
        $isCorrect = Answer::where([
            'id' => $answerId,
            'question_id' => $questionId,
        ])->first([
            'is_correct'
        ]);

        $status = $isCorrect ? QuestionStatus::CORRECT : QuestionStatus::INCORRECT

        Game::where([
            'token' => $token,
            'game_id' => $gameId,
            'question_id' => $questionId
        ])->update([
            'status' => $status
        ]);

        return $this->gameRetriever->get($token, $gameId);
    }

    public function reset($gameId)
    {
        return;
    }
}
