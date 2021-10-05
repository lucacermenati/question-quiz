<?php

namespace App\Service;

use App\Models\Question;

class QuestionRetriever
{
    public function getAll()
    {
        return Question::all()->toArray();
    }
}
