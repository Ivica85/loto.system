<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numbers',
        'price',
    ];


    public static function getAllTicketsForPast7days(): ?Collection
    {
        return self::whereDate(
          'created_at','>',Carbon::now()->subDays(7)
        )->get();
    }

    public static function getTotalPriceForPast7Days(): ?int
    {
        return self::whereDate(
            'created_at','>',Carbon::now()->subDays(7)
        )->get()->sum('price');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
