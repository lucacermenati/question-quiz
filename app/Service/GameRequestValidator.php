<?php

namespace App\Service;

use App\Enum\QuestionStatus;
use App\Exceptions\AlreadyCorrectAnswerException;
use App\Exceptions\AnswerNotFoundException;
use App\Exceptions\GameNotFoundException;
use App\Exceptions\QuestionOnGameNotFoundException;
use App\Models\Answer;
use App\Models\Game;

class GameRequestValidator
{
    /**
     * @param $request
     * @throws GameNotFoundException
     */
    public function validate($request)
    {
        $this->validateGame($request->token, $request->game_id);
    }

    /**
     * @param $request
     * @throws AlreadyCorrectAnswerException
     * @throws AnswerNotFoundException
     * @throws GameNotFoundException
     * @throws QuestionOnGameNotFoundException
     */
    public function validatePlay($request)
    {
        $this->validateGame($request->token, $request->game_id);
        $this->validateQuestion($request->token, $request->game_id, $request->question_id);
        $this->validateAnswer($request->question_id, $request->answer_id);
    }

    public function validateGameExists($request)
    {
        $game = Game::where([
            'game_id' => $request->game_id,
        ])->first();

        if (!$game) {
            throw new GameNotFoundException($request->game_id);
        }
    }

    private function validateGame($token, $gameId)
    {
        $game = Game::where([
            'token' => $token,
            'game_id' => $gameId,
        ])->first();

        if (!$game) {
            throw new GameNotFoundException($gameId);
        }
    }

    private function validateQuestion($token, $gameId, $questionId)
    {
        $game = Game::where([
            'token' => $token,
            'game_id' => $gameId,
            'question_id' => $questionId
        ])->first();

        if (!$game) {
            throw new QuestionOnGameNotFoundException($questionId);
        }

        if ($game->status == QuestionStatus::CORRECT) {
            throw new AlreadyCorrectAnswerException();
        }
    }

    private function validateAnswer($questionId, $answerId)
    {
        $answer = Answer::where([
            'id' => $answerId
        ])->first();

        if (!$answer || $answer->question_id != $questionId) {
            throw new AnswerNotFoundException($answerId, $questionId);
        }
    }
}
