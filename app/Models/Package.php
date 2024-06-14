<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'validity',
        'price',
        'is_active'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
