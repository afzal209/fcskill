<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_option;
use App\Models\VerifySignalUser;
use Carbon\Carbon;
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

    public function app_ads(){
        return view('app_ads');
    }

    public function signalverify($token){
        date_default_timezone_set('Asia/Karachi');
        $verify_signal_user = VerifySignalUser::where('token',$token)->first();
        // $create_at = date("Y-m-d H:i:s", strtotime($verify_signal_user->created_at));
        // return $verify_signal_user->signalUser;
        $create = Carbon::createFromFormat('Y-m-d H:i:s', $verify_signal_user->created_at);
        // return $create->toDateString();
        $current = Carbon::now()->toDateTimeString();
        $diff = $create->diffInMinutes($current);
        // return $diff;
        $date = $create->toDateString();
        // return $date;

        if (date("Y-m-d") === $date ) {
            # code...
             if ($diff < 5 ) {
            # code...
                // echo 'Available';
                if (isset($verify_signal_user)) {
                //     # code...
                    $user = $verify_signal_user->signalUser;
                    // return $user;
                    if (!$user->email_verified_at) {
                        # code...
                        $user->email_verified_at = date("Y-m-d H:i:s", strtotime('now'));
                        $user->save();
                        return redirect('signal-type')->with('doneMessage','Your Email has been verified');
                    }
                    else{
                        return redirect('signal-type')->with('doneMessage','Already Verified');
                    }
                }
            }
            else{
                return redirect('signal-type')->with('errorMessage','Expired');
                // echo 'Expired';
            }
        }
        else{
            $verify_signal_user = VerifySignalUser::where('token',$token)->first();
            // return $verify_signal_user->signalUser;
            if (is_null($verify_signal_user->signalUser->email_verified_at)) {
                # code...
                // echo 'Null';
                $verify_signal_user->delete();
                return redirect('signal-type')->with('errorMessage','Kindly send verify link again by clicking on verify Button');
            }
            else{
                return redirect('signal-type')->with('doneMessage','Already Verified');
                // echo 'Not Null';
            }
        }

        // $a = strptime($create_at , '%Y-%m-%d');
        // $timestamp = mktime(0, 0, 0, $a['tm_mon']+1, $a['tm_mday'], $a['tm_year']+1900);
        // return $timestamp;
    }

}
