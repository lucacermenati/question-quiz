<?php

namespace App\Service;

use App\Enum\QuestionStatus;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class StatsCalculator
{
    public function calculateTotalQuestions($token, $gameId)
    {
        return Game::query()
        ->where([
            'token' => $token,
            'game_id' => $gameId,
        ])->count();
    }

    public function calculateAnsweredQuestions($token, $gameId)
    {
        $total = $this->calculateTotalQuestions($token, $gameId);

        $answered =  Game::query()
            ->where([
                'token' => $token,
                'game_id' => $gameId,
            ])->whereIn('status', array(QuestionStatus::CORRECT, QuestionStatus::INCORRECT))
            ->count();

        return $answered / $total *100;
    }

    public function calculateCorrectQuestions($token, $gameId)
    {
        $total = $this->calculateTotalQuestions($token, $gameId);

        $correct =  Game::query()
            ->where([
                'token' => $token,
                'game_id' => $gameId,
                'status' => QuestionStatus::CORRECT
            ])->count();

        return $correct / $total *100 ;
    }
}
