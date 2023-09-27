<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCreditsRequest;
use App\Models\Transactions;

class CreditsController extends Controller
{


    public function add(AddCreditsRequest $request){
        $creditsPrice = $request->credits * env('CREDITS_VALUE_RSD');

        $user = auth()->user();

        $currentCredits = $user->credits ?? 0;
        $user->credits += $request['credits'];
        $user->save();

        Transactions::create([
            'card_id' => $request['credit_card'],
            'amount'  => $request['credits'],
            'price'   => env("CREDITS_VALUE_RSD"),
            'total_price' =>  $request['credits'] * env("CREDITS_VALUE_RSD"),
            'status' => Transactions::STATUS_ACTIVE,
        ]);


        return redirect()->back();
    }
}

