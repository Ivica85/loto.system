<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketPurchaseRequest;
use App\Models\Tickets;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{

    public function buy(TicketPurchaseRequest $request)
    {
        Tickets::create([
            'user_id' => auth()->user()->id,
            'numbers' => implode(',',$request['numbers']),
            'price'   => env('TICKET_PRICE_CREDITS'),
        ]);

        $user =  Auth::user();
        $user->credits -= env('TICKET_PRICE_CREDITS');
        $user->save();

        return redirect()->back()->with(['message'=>'You have successfully purchased a lotto ticket. '. 'The remaining credit: '.$user->credits]);
    }



}
