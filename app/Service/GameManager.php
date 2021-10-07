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
        $answer = Answer::where([
            'id' => $answerId,
            'question_id' => $questionId,
        ])->first([
            'is_correct'
        ]);

        Game::where([
            'token' => $token,
            'game_id' => $gameId,
            'question_id' => $questionId
        ])->update([
            'status' => $answer->is_correct ? QuestionStatus::CORRECT : QuestionStatus::INCORRECT
        ]);

        return $this->gameRetriever->get($token, $gameId);
    }

    public function reset($token, $gameId)
    {
        Game::where([
            'token' => $token,
            'game_id' => $gameId,
        ])->update([
            'status' => QuestionStatus::NOT_ANSWERED
        ]);

        return $this->gameRetriever->get($token, $gameId);
    }
}
