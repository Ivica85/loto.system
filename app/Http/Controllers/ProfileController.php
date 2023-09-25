<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAccountSaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function save(UserAccountSaveRequest $request){

        $user = Auth::user();
        $user->email = $request->email;
        $user->name = $request->name;

        if($request->has('password') && strlen($request['password']) >=1){
                $user->password = Hash::make($request['password']);
            }

        $user->save();

        return redirect()->back();

    }


}
