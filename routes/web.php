<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/','pages.home');


Route::middleware('auth')->group(function(){

    Route::view('/lotto','pages.lotto')->name('lotto.index');

    Route::controller(\App\Http\Controllers\ProfileController::class)->prefix('/profile')->group(function(){
        Route::view('/','pages.profile');
        Route::view('/add-credits','pages.add_credits')->name('profile.add_credits');
        Route::post('/save','save')->name("profile.save");
    });


    Route::controller(App\Http\Controllers\CreditsController::class)->prefix('/credits')->group(function(){
        Route::post('/add','add')->name('credits_add');
    });


    Route::controller(\App\Http\Controllers\CreditCardsController::class)->prefix('/credit-cards')->group(function(){
        Route::post('/save','save')->name("cards.save");
        Route::get('/delete/{card}','delete')->name('cards_delete');
    });



    Route::controller(App\Http\Controllers\TicketsController::class)->prefix('lotto')->group(function(){
        Route::post("/buy",'buy')->name('lotto.buy');
    });

});

Auth::routes();



