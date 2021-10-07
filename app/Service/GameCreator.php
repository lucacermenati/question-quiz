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
        foreach ($this->questionRetriever->getAll()['questions'] as $question) {
            $game = Game::create([
                'token' => $token,
                'question_id' => $question['id'],
                'status' => QuestionStatus::NOT_ANSWERED,
                'active' => true,
            ]);

            $game->save(); //TODO: bulk insert
        }
    }
}
