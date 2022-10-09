<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GainProfit;
class GainProfitsController extends Controller
{
    //
    public function index(){
        $gainprofits = GainProfit::orderBy('created_at','desc')->get();
        return view('gainprofits',compact('gainprofits'));
    }
    // public function index_demo(){
    //     $gainprofits = GainProfit::orderBy('created_at','desc')->get();
    //     return view('gainprofits',compact('gainprofits'));
    // }

    public function check_status($id,$status){
        return 'Id'. $id .','.'Status'.$status;
    }
}
