<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCards extends Model
{
    use HasFactory;

    protected $table = "credit_cards";

    protected $fillable = [
        'card_number',
        'cvv',
        'expiry',
        'user_id',
    ];



}
