<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_option;

class HomeController extends Controller
{

    public function index()
    {
        return view('landing_page');
    }

    public function termsandconditions()
    {
        $data = General_option::where('meta_key', '=', 'terms_and_conditions')->first();
        return view('termandconditions', compact('data'));
    }

    public function webregister(){
        return view('web_register');
    }
    public function weblogin(){
        return view('web_login');
    }

    public function signaltype(){
        return view('signal_type');
    }

    public function websetting(){
        return view('web_setting');
    }

    public function chartweb(){
        return view('chart');
    }

    public function chartwebapp(){
        return view('chartapp');
    }

    public function newscalander(){
        return view('newscalander');
    }

    public function newscalanderapp(){
        return view('newscalanderapp');
    }
    public function tradingsession(){
        return view('tradingsession');
    }
    public function dailynews(){
        return view('dailynews');
    }

    public function forexbrokersranking(){
        return view('forexbrokersranking');
    }

    public function cryptobrokersranking(){
        return view('cryptobrokersranking');
        // echo 'Test';
    }

    public function technicalanalysis(){
        return view('technicalanalysis');
    }
    
    public function fundamentalanalysis(){
        return view('fundamentalanalysis');
    }

    public function privacy(){
        return view('privacy');
    }

}