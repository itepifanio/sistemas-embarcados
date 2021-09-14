<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueStatus extends Model
{
    use HasFactory;

    public const STATUSES = [
        1 => 'Vazia',
        2 => 'Quase Vazia',
        3 => 'Normal',
        4 => 'Cheia',
        5 => 'Extremamente Cheia',
    ];

    protected $fillable = [
        'camera_name',
        'camera_status',
    ];
}
