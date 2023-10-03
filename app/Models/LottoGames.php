<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LottoGames extends Model
{
    use HasFactory;

    protected $table = 'lotto_games';

    protected $fillable = [
      'numbers',
      'award_fund',
      'jackpot',
    ];
}
