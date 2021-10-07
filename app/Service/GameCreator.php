<?php

namespace App\Service;

use App\Enum\QuestionStatus;
use App\Models\Game;
use App\Models\Question;

class GameCreator
{
    /** @var QuestionRetriever */
    private $questionRetriever;

    /** @codeCoverageIgnore */
    public function __construct(QuestionRetriever $questionRetriever)
    {
        $this->questionRetriever = $questionRetriever;
    }

    public function create($token)
    {
        $gameId =  uniqid();

        foreach ($this->questionRetriever->getAll()['questions'] as $question) {
            $game = Game::create([
                'token' => $token,
                'game_id' => $gameId,
                'question_id' => $question['id'],
                'status' => QuestionStatus::NOT_ANSWERED,
            ]);

            $game->save(); //TODO: bulk insert
        }

        return $gameId;
    }
}
