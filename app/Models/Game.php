<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends CustomModel
{
    use HasFactory;

    public $fillable = [
        'token',
        'question',
        'status'
    ];
}
