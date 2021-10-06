<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends CustomModel
{
    use HasFactory;

    public $fillable = [
        'text',
        'is_correct',
        'question'
    ];
}
