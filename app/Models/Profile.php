<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'suffix',
        'firstname',
        'lastname',
        'middlename',
        'phone',
        'country',
        'street_address',
        'apt_no',
        'city',
        'state',
        'postcode',
        'org_name',
        'rcc_no',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
