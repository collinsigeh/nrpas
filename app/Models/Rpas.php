<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rpas extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'serial_no',
        'model_no',
        'cert_no',
        'nickname',
        'rpastype_id',
        'user_id',
        'safety_agreement',
        'registered_at'
    ];

    public function rpas(): BelongsTo
    {
        return $this->belongsTo(Rpas::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
