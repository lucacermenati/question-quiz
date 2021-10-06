<?php

namespace App\Service;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionRetriever
{
    public function getAllWithAnswers()
    {
        return Question::query()
            ->join('answers', 'questions.id', '=', 'answers.question_id')
            ->get(["questions.*", 'answers.text as answer_text', 'answers.is_correct']);
    }
}
