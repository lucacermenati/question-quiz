<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends CustomModel
{
    use HasFactory;

    public $fillable = [
        'token',
        'role',
    ];
}
