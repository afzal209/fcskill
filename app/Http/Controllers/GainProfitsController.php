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

    public function check_status(Request $request){
        date_default_timezone_set('Asia/Karachi');
        if ($request->status == 1) {
            # code...
            $gainprofits = GainProfit::find($request->id);
            // return $gainprofits;
            $gainprofits->status = 2;
            $gainprofits->created_at = date("Y-m-d H:i:s", strtotime('now'));
            $gainprofits->updated_at = date("Y-m-d H:i:s", strtotime('now'));
            $gainprofits->update();

            return response()->json(['data' => 'success']);
        }
        else{
            $gainprofits = GainProfit::find($request->id);
            // return $gainprofits;
            $gainprofits->delete();
            return response()->json(['data' => 'success']);
        }
        // return $request;
        
    }

    public function destroy($id)
    {
        $gainprofits = GainProfit::find($id);
        if ($gainprofits) {
            $gainprofits->delete();
            return redirect()->back()->with('doneMessage', 'Gain Profit Deleted');
        } else {
            return redirect()->back()->with('doneMessage', 'Gain Profit Not Exist!');
        }
    }
}
