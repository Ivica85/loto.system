<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numbers',
        'price',
    ];

    public static function getForPast7Days(): ?int
    {
        return self::whereDate(
            'created_at','>',Carbon::now()->subDays(7)
        )->get()->sum('price');
    }

}
