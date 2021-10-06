<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends CustomModel
{
    use HasFactory;

    public $fillable = [
        'email',
        'password',
        'role',
        'token',
    ];
}
