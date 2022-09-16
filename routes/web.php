<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SignalsController;
use App\Http\Controllers\PredictionIdeasController;
use App\Http\Controllers\MarketEductionsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TradingTipsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms-and-conditions', [HomeController::class, 'termsandconditions'])->name('termsandconditions');
Route::get('/web-register',[HomeController::class,'webregister'])->name('webregister');
Route::get('/web-login', [HomeController::class, 'weblogin'])->name('weblogin');
Route::get('/signal-type', [HomeController::class, 'signaltype'])->name('signaltype');
Route::get('/web-setting',[HomeController::class, 'websetting'])->name('websetting');
Route::get('/chart-web',[HomeController::class,'chartweb'])->name('chartweb');
Route::get('/chart-web-app',[HomeController::class,'chartwebapp'])->name('chartwebapp');
Route::get('/news-calander',[HomeController::class,'newscalander'])->name('newscalander');
Route::get('/news-calander-app',[HomeController::class,'newscalanderapp'])->name('newscalanderapp');
Route::get('/trading-session',[HomeController::class,'tradingsession'])->name('tradingsession');
Route::get('/daily-news',[HomeController::class,'dailynews'])->name('dailynews');
Route::get('/forex-brokers-ranking',[HomeController::class,'forexbrokersranking'])->name('forexbrokersranking');
Route::get('/crypto-brokers-ranking',[HomeController::class,'cryptobrokersranking'])->name('cryptobrokersranking');
Route::get('/technical-analysis',[HomeController::class,'technicalanalysis'])->name('technicalanalysis');
Route::get('/fundamental-analysis',[HomeController::class,'fundamentalanalysis'])->name('fundamentalanalysis');
Route::get('/privacy-policy-&-terms-and-conditions',[HomeController::class,'privacy'])->name('privacy');
Route::get('/app-ads.txt',[HomeController::class,'app_ads'])->name('app_ads');


Route::group(['middleware' => ['isLoggedin']], function() {
	Route::get('/login', [LoginController::class, 'login']);
	Route::get('/admin', [LoginController::class, 'login']);
	Route::get('/admin/login', [LoginController::class, 'login']);
	Route::post('login', [LoginController::class, 'store'])->name('login');
	Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget_password');
	Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])->name('send_reset_link');
	Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset_password');
	Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('update_password');
});

Route::group(['middleware' => ['isAllowed']], function () {

	Route::get('/admin/logout', [LogoutController::class, 'logout'])->name('logout');
	Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

		//Signals
	Route::get('/admin/signals', [SignalsController::class, 'index'])->name('signals');
	Route::get('/admin/signals/add', [SignalsController::class, 'add'])->name('add_signal');
	Route::post('/admin/signals/store', [SignalsController::class, 'store'])->name('store_signal');
	Route::get('/admin/signals/edit/{id}', [SignalsController::class, 'edit'])->name('signal_edit');
	Route::patch('/admin/signals/update/{id}', [SignalsController::class, 'update'])->name('signal_update');
	Route::delete('/admin/signals/destory/{id}', [SignalsController::class, 'destroy'])->name('signal_delete');
	Route::post('/admin/signals/image_upload', [SignalsController::class, 'upload'])->name('upload_signal_image');

	// Prediction Ideas
		
	Route::get('/admin/predictions', [PredictionIdeasController::class, 'index'])->name('predictions');
	Route::get('/admin/predictions/add', [PredictionIdeasController::class, 'add'])->name('add_predictions');
	Route::post('/admin/predictions/store', [PredictionIdeasController::class, 'store'])->name('store_predictions');
	Route::get('/admin/predictions/edit/{id}', [PredictionIdeasController::class, 'edit'])->name('predictions_edit');
	Route::patch('/admin/predictions/update/{id}', [PredictionIdeasController::class, 'update'])->name('predictions_update');
	Route::delete('/admin/predictions/destory/{id}', [PredictionIdeasController::class, 'destroy'])->name('predictions_delete');
	Route::post('/admin/predictions/image_upload', [PredictionIdeasController::class, 'upload'])->name('upload_predictions_image');
	// Trading Tips
	Route::get('/admin/tradings', [TradingTipsController::class, 'index'])->name('tradings');
	Route::get('/admin/tradings/add', [TradingTipsController::class, 'add'])->name('add_tradings');
	Route::post('/admin/tradings/store', [TradingTipsController::class, 'store'])->name('store_tradings');
	Route::get('/admin/tradings/edit/{id}', [TradingTipsController::class, 'edit'])->name('tradings_edit');
	Route::patch('/admin/tradings/update/{id}', [TradingTipsController::class, 'update'])->name('tradings_update');
	Route::delete('/admin/tradings/destory/{id}', [TradingTipsController::class, 'destroy'])->name('tradings_delete');
	Route::post('/admin/tradings/image_upload', [TradingTipsController::class, 'upload'])->name('upload_tradings_image');
	
	Route::get('/admin/no_access', [DashboardController::class, 'no_access'])->name('no_access');

});

Route::group(['middleware' => ['admin']], function () {

	//Market Education
	Route::get('/admin/market_education', [MarketEductionsController::class, 'index'])->name('market_education');
	Route::patch('/admin/market_education/update', [MarketEductionsController::class, 'update'])->name('market_education_update');
	Route::post('/admin/market_education/image_upload', [MarketEductionsController::class, 'upload'])->name('upload_market_education_image');

	//Brokers Ranking
	Route::get('/admin/brokers-ranking', [SettingsController::class, 'brokers_ranking'])->name('brokers_ranking');
	Route::patch('/admin/brokers-ranking/update', [SettingsController::class, 'brokers_ranking_update'])->name('brokers_ranking_update');
	Route::post('/admin/brokers-ranking/image_upload', [SettingsController::class, 'upload'])->name('upload_brokers_ranking_image');

	//Terms and conditions
	Route::get('/admin/terms-and-conditions', [SettingsController::class, 'terms_and_conditions'])->name('terms_and_conditions');
	Route::patch('/admin/terms-and-conditions/update', [SettingsController::class, 'terms_update'])->name('terms_and_conditions_update');
	Route::post('/admin/terms-and-conditions/image_upload', [SettingsController::class, 'upload'])->name('upload_terms_and_conditions_image');

	//settings
	Route::get('/admin/settings', [SettingsController::class, 'settings'])->name('settings');
	Route::patch('/admin/change_password', [SettingsController::class, 'change_password'])->name('change_password');

	Route::patch('/admin/update_support_details', [SettingsController::class, 'update_support_details'])->name('update_support_details');

	// News
	Route::get('/admin/news',[NewsController::class,'index'])->name('news');
	Route::get('/admin/news/add', [NewsController::class, 'add'])->name('add_news');
	Route::post('/admin/news/store', [NewsController::class, 'store'])->name('store_news');
	Route::get('/admin/news/edit/{id}', [NewsController::class, 'edit'])->name('news_edit');
	Route::patch('/admin/news/update/{id}',[NewsController::class,'update'])->name('news_update');
	Route::delete('/admin/news/destory/{id}', [NewsController::class, 'destroy'])->name('news_delete');
	Route::post('/admin/news/image_upload', [NewsController::class, 'upload'])->name('upload_news_image');
	
	
	//Roles
	Route::get('/admin/roles', [RolesController::class, 'index'])->name('roles');
	Route::get('/admin/roles/add', [RolesController::class, 'add'])->name('add_role');
	Route::post('/admin/roles/store', [RolesController::class, 'store'])->name('store_role');
	Route::get('/admin/roles/edit/{id}', [RolesController::class, 'edit'])->name('role_edit');
	Route::patch('/admin/roles/update/{id}', [RolesController::class, 'update'])->name('role_update');
	Route::delete('/admin/roles/destory/{id}', [RolesController::class, 'destroy'])->name('role_delete');

});



Route::get('/clearcache', function () {
	$exitCode = Artisan::call('config:clear');
	$exitCode = Artisan::call('cache:clear');
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});