<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends CustomModel
{
    use HasFactory;

    public $fillable = [
        'text',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
