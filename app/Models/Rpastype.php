<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rpastype extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function rpases(): HasMany
    {
        return $this->hasMany(Rpas::class);
    }
}
