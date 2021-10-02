<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{
    use HasFactory;

    public $fillable = [
        'email',
        'password',
        'role',
        'token',
    ];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}
