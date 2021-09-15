<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueStatus extends Model
{
    use HasFactory;

    public const STATUSES = [
        0 => 'Vazia',
        1 => 'Quase Vazia',
        2 => 'Normal',
        3 => 'Cheia',
        4 => 'Extremamente Cheia',
    ];

    protected $fillable = [
        'queue_status',
    ];

    public function restaurant() {
        return $this->belongsTo(Restaurants::class);
    }
}
