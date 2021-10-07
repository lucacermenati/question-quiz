<?php

namespace App\Service;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionRetriever
{
    /** @var QuestionBeautifier */
    private $questionBeautifier;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(QuestionBeautifier $questionCollectionBeautifier)
    {
        $this->questionBeautifier = $questionCollectionBeautifier;
    }

    public function getAll()
    {
        $questions =  Question::query()
            ->join('answers', 'questions.id', '=', 'answers.question_id')
            ->get(["questions.*", 'answers.text as answer_text', 'answers.is_correct']);

        return $this->questionBeautifier->beautifyCollection($questions);
    }

    public function getById($id)
    {
        $question =  Question::query()
            ->join('answers', 'questions.id', '=', 'answers.question_id')
            ->where([
                "id" => $id
            ])
            ->first(["questions.*", 'answers.text as answer_text', 'answers.is_correct']);

        return $question;
    }
}
