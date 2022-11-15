<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fcm_token;
use App\Models\User;
use App\Models\Signal_User;

class DashboardController extends Controller
{
    public function index() 
    {
        $both_users = Fcm_token::where('user_choice' , '=', 0)->count();
       
        $forex_users = Fcm_token::where('user_choice' , '=', 1)->count();
        
        $crypto_users = Fcm_token::where('user_choice' , '=', 2)->count();
        
        $web_both_users = Signal_User::where('signal_type' , '=', 0)->count();
        $web_forex_users = Signal_User::where('signal_type' , '=', 1)->count();
        $web_crypto_users = Signal_User::where('signal_type' , '=', 2)->count();
        return view('dashboard', compact('both_users', 'forex_users', 'crypto_users','web_both_users', 'web_forex_users', 'web_crypto_users'));
    }

    public function no_access()
    {
        return view('no_access');
    }

}