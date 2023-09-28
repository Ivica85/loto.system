<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;

class TicketsController extends Controller
{

    public function buy(Request $request)
    {
        Tickets::create([
            'user_id' => auth()->user()->id,
            'numbers' => implode(',',$request['numbers']),
            'price'   => env('TICKET_PRICE_CREDITS'),
        ]);

        return redirect()->back();
    }



}
