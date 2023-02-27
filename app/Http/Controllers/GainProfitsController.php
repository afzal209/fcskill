<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GainProfit;
use App\Models\User;
use App\Models\User_Has_Permission;
class GainProfitsController extends Controller
{
    //
    public function index(){
        if (auth()->user()->user_role == 1) {
            $gainprofits = GainProfit::orderBy('created_at','desc')->get();
        }
        else{
           
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',1);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $gainprofits = GainProfit::orderBy('created_at','desc')->get();
                    // return view('gainprofits',compact('gainprofits'));
                } 
            
        }
        return view('gainprofits',compact('gainprofits'));

    }
    // public function index_demo(){
    //     $gainprofits = GainProfit::orderBy('created_at','desc')->get();
    //     return view('gainprofits',compact('gainprofits'));
    // }

    public function check_status(Request $request){
        if (auth()->user()->user_role == 1) {
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
        }
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',1);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return response()->json(['data' => 'access']);
                }
                else{
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
                }
            
        }
        
        // return $request;
        
    }

    public function destroy($id)
    {
        if (auth()->user()->user_role == 1) {
            $gainprofits = GainProfit::find($id);
            if ($gainprofits) {
                $gainprofits->delete();
                return redirect()->back()->with('doneMessage', 'Gain Profit Deleted');
            } else {
                return redirect()->back()->with('doneMessage', 'Gain Profit Not Exist!');
            }
        }
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',1);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $gainprofits = GainProfit::find($id);
                    if ($gainprofits) {
                        $gainprofits->delete();
                        return redirect()->back()->with('doneMessage', 'Gain Profit Deleted');
                    } else {
                        return redirect()->back()->with('doneMessage', 'Gain Profit Not Exist!');
                    }
                }
            
        }
    }
}
