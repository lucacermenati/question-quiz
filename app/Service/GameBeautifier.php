<?php

namespace App\Service;

class GameBeautifier
{
    public function beautify($game)
    {
        $result = [];

        foreach ($game as $item) {
            if(!array_key_exists($item->id, $result)) {
                $result[$item->id] = [
                    "id" => $item->id,
                    "text" => $item->text,
                    "status" => $item->status,
                    "answers" => [[
                        "text" => $item->answer_text,
                    ]],
                ];
            } else {
                $result[$item->id]["answers"][] = [
                    "text" => $item->answer_text,
                ];
            }
        }

        return [
            "questions" => array_values($result)
        ];
    }
}
