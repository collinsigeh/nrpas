<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempuser extends Model
{
    use HasFactory;

    protected $fillable = [
        'confirm_code',
        'email',
        'password'
    ];
}
