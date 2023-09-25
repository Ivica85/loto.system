<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditCards\NewCardRequest;
use App\Models\CreditCards;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CreditCardsController extends Controller
{
    public function save(NewCardRequest $request){

        $date  = Carbon::createFromDate($request->get('expiry_year'), $request->get('expiry_month'),1);
        $creditCards = new CreditCards();
        $creditCards->card_number = $request->card_number;
        $creditCards->cvv = $request->cvv;
        $creditCards->expiry = $request->get('expiry_month')."/".$request->get('expiry_year');
        $creditCards->user_id = Auth::id();
        $creditCards->expiry = $date;
        $creditCards->save();

        return redirect()->back();
    }

    public function delete(CreditCards $card){
       if($card->user_id !== Auth::id()){
           return redirect()->back();
       }

       $card->delete();

       return redirect()->back();
    }


}
