<?php

namespace App\Http\Resources;

use App\Models\Question;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [];

        foreach ($this->collection as $item) {
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
            "success" => true,
            "questions" => array_values($result)
        ];
    }
}
