<?php

namespace App\Service;

use App\Models\Answer;
use App\Models\Game;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class GameRetriever
{
    /** @var GameBeautifier */
    private $gameBeautifier;

    /** @var QuestionRetriever */
    private $questionRetriever;

    /** @codeCoverageIgnore */
    public function __construct(GameBeautifier $gameBeautifier, QuestionRetriever $questionRetriever)
    {
        $this->gameBeautifier = $gameBeautifier;
        $this->questionRetriever = $questionRetriever;
    }

    public function get($token)
    {
        $game =  Game::query()
        ->join('questions', 'questions.id', '=', 'games.question_id')
        ->join('answers', 'questions.id', '=', 'answers.question_id')
        ->where([
            'token' => $token
        ])
        ->get(["games.*", "questions.*", 'answers.text as answer_text',]);

        return $this->gameBeautifier->beautify($game);
    }
}
