<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('add_fcm_token', [ApiController::class, 'add_fcm_token'], 'add_fcm_token');

Route::get('signals', [ApiController::class, 'signals']);
Route::post('new_signals', [ApiController::class, 'new_signals'])->name('new_signals');
Route::get('prediction_ideas',[ApiController::class,'prediction_ideas']);
Route::post('new_prediction_ideas', [ApiController::class, 'new_prediction_ideas'])->name('new_prediction_ideas');
Route::post('new_trading_tips',[ApiController::class, 'new_trading_tips'])->name('new_trading_tips');


Route::get('forex_signals', [ApiController::class, 'forex_signals']);
Route::get('crypto_signals', [ApiController::class, 'crypto_signals']);
Route::get('forex_prediction', [ApiController::class, 'forex_prediction']);
Route::get('crypto_prediction', [ApiController::class, 'crypto_prediction']);
Route::get('trading_tips',[ApiController::class,'trading_tips']);

Route::get('technical_analysis', [ApiController::class, 'technical_analysis']);
Route::get('fundamental_analysis', [ApiController::class, 'fundamental_analysis']);

Route::get('forex_brokers_ranking', [ApiController::class, 'forex_brokers_ranking']);
Route::get('crypto_brokers_ranking', [ApiController::class, 'crypto_brokers_ranking']);

Route::get('daily_news_add',[ApiController::class,'daily_news_add']);

Route::get('terms_and_conditions', [ApiController::class, 'terms_and_conditions']);

Route::get('support', [ApiController::class, 'support']);
Route::post('gain_profits_add',[ApiController::class,'gain_profits_add']);
Route::get('gain_profits_show',[ApiController::class,'gain_profits_show']);

Route::post('register',[RegisterController::class,'register']);

Route::post('login',[RegisterController::class,'login'] );
// Route::group(['middleware' => ['auth:sanctum']], function () {
Route::middleware('auth:sanctum')->group( function () {

    Route::get('signal_check/{type}',[ApiController::class,'signal_check']);
    Route::get('web_setting/(text}',[ApiController::class,'web_setting']);
    Route::post('signal_notify',[ApiController::class,'signal_notify']);
});

// Route::get('/web_setting/(text}',[ApiController::class,'web_setting']);