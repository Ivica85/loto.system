<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardLog extends Model
{
    use HasFactory;

    protected $table = 'award_log';

    protected $fillable = [
        'user_id',
        'game_id',
        'award',
    ];
}
