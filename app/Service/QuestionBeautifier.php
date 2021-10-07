<?php

namespace App\Service;

class QuestionBeautifier
{
    public function beautifyCollection($questionCollection)
    {
        $result = [];

        foreach ($questionCollection as $item) {
            if(!array_key_exists($item->id, $result)) {
                $result[$item->id] = [
                    "id" => $item->id,
                    "text" => $item->text,
                    "answers" => [[
                        "text" => $item->answer_text,
                        "is_correct" => $item->is_correct
                    ]],
                ];
            } else {
                $result[$item->id]["answers"][] = [
                    "text" => $item->answer_text,
                    "is_correct" => $item->is_correct
                ];
            }
        }

        return [
            "questions" => array_values($result)
        ];
    }
}
