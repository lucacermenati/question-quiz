<?php

namespace App\Service;

use App\Enum\QuestionStatus;
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

    public function get($token, $gameId)
    {
         $game =  Game::query()
        ->join('questions', 'questions.id', '=', 'games.question_id')
        ->join('answers', 'questions.id', '=', 'answers.question_id')
        ->where([
            'token' => $token,
            'game_id' => $gameId
        ])
        ->whereIn('status', [
            QuestionStatus::INCORRECT,
            QuestionStatus::NOT_ANSWERED,
        ])
        ->get(["games.*", "questions.*", 'answers.text as answer_text', 'answers.id as answer_id']);

        return $this->gameBeautifier->beautify($game);
    }
}
