<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends CustomModel
{
    use HasFactory;

    public $fillable = [
        'token',
        'game_id',
        'question_id',
        'status',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
