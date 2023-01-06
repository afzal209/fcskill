<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifiedEmail;
use App\Models\Signal;
use App\Models\Market_education;
use App\Models\General_option;
use App\Models\Fcm_token;
use App\Models\News;
use App\Models\PredictionIdeas;
use App\Models\TradingTips;
use App\Models\NotificationStatus;
use App\Models\GainProfit;
use App\Models\AppSetting;
use App\Models\Signal_User;
use App\Models\VerifySignalUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{

    public function add_fcm_token(Request $request)
    {
        if (Fcm_token::where('device_id', $request->device_id)->exists()) {
            $fcm_token = Fcm_token::where('device_id', '=', $request->device_id)->first();
            $fcm_token->user_choice = $request->user_choice;
            $fcm_token->fcm_token = $request->fcm_token;
            $fcm_token->update();
            return response()->json(["message" => "Records updated."], 200);
        } else {
            $fcm_token = new Fcm_token;
            $fcm_token->device_id = $request->device_id;
            $fcm_token->user_choice = $request->user_choice;
            $fcm_token->fcm_token = $request->fcm_token;
            $fcm_token->save();
            return response()->json(["message" => "Record created."], 200);
        }
    }

    public function notif_settings(Request $request)
    {
        if (!empty($request->device_id)) {
            $notif_detail = Fcm_token::where('device_id', $request->device_id)->first(['signals_notif', 'prediction_notif', 'updates_notif']);
            return response()->json(['data' => $notif_detail], 200);
        } else {
            return response()->json(['data' => array()], 200);
        }
    }

    public function update_set_notif(Request $request)
    {
        if (!isset($request->device_id) || !isset($request->signals_notif) || !isset($request->prediction_notif) || !isset($request->updates_notif)) {
            return response()->json(['error' => 'API parameters are missing.']);
        } else {
            if (Fcm_token::where('device_id', $request->device_id)->exists()) {
                $fcm_token = Fcm_token::where('device_id', '=', $request->device_id)->first();
                $fcm_token->signals_notif = $request->signals_notif;
                $fcm_token->prediction_notif = $request->prediction_notif;
                $fcm_token->updates_notif = $request->updates_notif;
                $fcm_token->update();
            }
            return response()->json(['success' => 'Successfully saved.']);
        }
    }

    public function signals(Request $request)
    {
        $signals = Signal::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $signals], 200);
    }
    // for web
    public function signal_check($type)
    {
        if ($type == 0) {
            $signal_check = Signal::where('signal_type', 0)->orderBy('created_at', 'desc')->paginate(10);
        } else if ($type == 1) {
            $signal_check = Signal::where('signal_type', 1)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $signal_check = Signal::orderBy('created_at', 'desc')->paginate(10);
        }
        return response()->json(['data' => $signal_check], 200);
    }

    public function signal_notify(Request $request)
    {
        // return $request;
        if ($request->action == 'view') {
            # code...
            if ($request->type == 0) {
                // $signal_notify = NotificationStatus::where('notify',0)->where('type',0)->where('user_id',$request->user_id)->count();
                $signal_notify = DB::table('notification_statuses')
                    ->select(DB::raw('count(*) as user_count,notification_text, created_at'))
                    ->where('notify', 0)->where('type', 0)->where('user_id', $request->user_id)
                    ->groupBy('created_at','notification_text')
                    ->get();
            } else if ($request->type == 1) {
                // $signal_notify = NotificationStatus::where('notify', 0)->where('type', 1)->where('user_id', $request->user_id)->count();
                $signal_notify = DB::table('notification_statuses')
                ->select(DB::raw('count(*) as user_count,notification_text, created_at'))
                ->where('notify', 0)->where('type', 1)->where('user_id', $request->user_id)
                ->groupBy('created_at','notification_text')
                ->get();
            } else {
                // $signal_notify = NotificationStatus::where('notify', 0)->where('type', 2)->where('user_id', $request->user_id)->count();
                $signal_notify = DB::table('notification_statuses')
                ->select(DB::raw('count(*) as user_count,notification_text, created_at'))
                ->where('notify', 0)->where('type', 2)->where('user_id', $request->user_id)
                ->groupBy('created_at','notification_text')
                ->get();
            }
            if (!$signal_notify->isEmpty()) {
                return response()->json(['data' => $signal_notify]);
            } else {
                return response()->json(['data' => 0]);
            }
        } else if ($request->action == 'update') {
            $signal_notify = NotificationStatus::where('notify', 0)->where('type', $request->type)->where('user_id', $request->user_id)->get();
            // return $signal_notify;
            if (!$signal_notify->isEmpty()) {
                // echo 'Yes';
                foreach ($signal_notify as $signal_not) {
                    // print_r($signal_not['id']);
                    $update_signal_not = NotificationStatus::find($signal_not['id']);
                    // print_r($update_signal_not);
                    $update_signal_not->notify = 1;
                    $update_signal_not->update();
                }
                return response()->json(['count' => 1]);
            } else {
                // echo 'No';
                return response()->json(['count' => 0]);
            }

            // return '';
        }
        else if($request->action == 'flag'){
            $signal_notify = NotificationStatus::where('flag', 0)->where('type', $request->type)->where('user_id', $request->user_id)->get();
            // return $signal_notify;
            if (!$signal_notify->isEmpty()) {
                // echo 'Yes';
                foreach ($signal_notify as $signal_not) {
                    // print_r($signal_not['id']);
                    $update_signal_not = NotificationStatus::find($signal_not['id']);
                    // print_r($update_signal_not);
                    $update_signal_not->flag = 1;
                    $update_signal_not->update();
                }
                return response()->json(['count' => 1]);
            } else {
                // echo 'No';
                return response()->json(['count' => 0]);
            }
        }

        // // $signal_notify = Signal::where('is_notify',0)->where('signal_type',$notify_type)->first();
        // // return $signal_notify;
        // if($signal_notify){
        //     $signal_update_notify = Signal::find($signal_notify->id);
        //     // return $signal_update_notify;
        //     $signal_update_notify->is_notify = 1;
        //     $signal_update_notify->update();

        // return response()->json(['data' , 1]);
        // }
        // else{
        // return response()->json(['data' , 0]);

        // }

    }

    public function check_verified_email($id){
        $check_verified = Signal_User::where('id',$id)->first();
        if($check_verified->email_verified_at == null){
            if ($check_verified->verifySignalUser == null) {
                return response()->json(['data' => 1]);
            }
            else if ($check_verified->verifySignalUser->token != null){
                return response()->json(['data' => 2]);
            }


            // echo 'Yes';
        }

        else{
            // echo 'No';
            return response()->json(['data' => 0]);
        }
    }
    public function check_device_id(Request $request){
        $check_signal_user = Signal_User::where('id',$request->id)->whereNotNull('device_id')->get();
        if ($check_signal_user->empty()) {
            $signal_user = Signal_User::find($request->id);
            // return $signal_user;
            $signal_user->device_id = $request->device_id;
            $signal_user->save();
            return response()->json(["message" => "Records Inserted."], 200);
        }
        else{
            $signal_user = Signal_User::find($request->id);
            // return $signal_user;
            $signal_user->device_id = $request->device_id;
            $signal_user->update();
            return response()->json(["message" => "Records updated."], 200);
        }
    }

    public function verify_user(Request $request){
        date_default_timezone_set('Asia/Karachi');
        // return $request;
        $signal_user = Signal_User::where('id',$request->id)->first();
        // return $signal_user;
        $verifysignaluser = new VerifySignalUser();
        $verifysignaluser->user_id = $request->id;
        $verifysignaluser->token = Str::random(60);
        $verifysignaluser->created_at = date("Y-m-d H:i:s", strtotime('now'));
        $verifysignaluser->updated_at = date("Y-m-d H:i:s", strtotime('now'));
        if($verifysignaluser->save()){
            $mail = Mail::to($signal_user->email)->send(new VerifiedEmail($signal_user));
            if ($mail) {
                # code...
                return response()->json(['msg' => 'Check your email']);
            }
            else{
                return response()->json(['error' => 'Email Not send']);
            }
        }
        else{
            return response()->json(['error' => 'Same thing went wrong']);
        }
    }
    // public function notification_status_view(Request $request){
    //     $appsetting = AppSetting::where('device_id',$request->device_id)->where('category_type',$request->category_type)->first();
    //     return response()->json(['data' => $appsetting],200);
    // }

    public function notification_status_update(Request $request)
    {
        if (AppSetting::where('device_id', $request->device_id)->exists()) {
            # code...
            $appsetting = AppSetting::where('device_id', '=', $request->device_id)->first();
            $appsetting->signals_status = $request->signals_status;
            $appsetting->prediction_status = $request->prediction_status;
            $appsetting->tips_status =  $request->tips_status;
            $appsetting->update();
            return response()->json(['data' => 'Notification Has Been Updated']);
        } else {
            $appsetting = new AppSetting;
            $appsetting->device_id = $request->device_id;
            $appsetting->signals_status = $request->signals_status;
            $appsetting->prediction_status = $request->prediction_status;
            $appsetting->tips_status =  $request->tips_status;
            $appsetting->save();
            return response()->json(['data' => 'Notification Has Been Added']);
        }
    }
    public function prediction_ideas(Request $request)
    {
        // return $request;
        $prediction_ideas = PredictionIdeas::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $prediction_ideas], 200);
    }
    public function web_setting($text)
    {
        return $text;
        // $web_setting_get = User::where('id',$id)->first();
        // return response()->json(['data',$web_setting_get]);
    }

    public function new_signals(Request $request)
    {
        if ($request->user_choice == 0) {
            $signals = Signal::where('id', '>', $request->id)->where('signal_type', '=', 0)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $signals], 200);
        } else if ($request->user_choice == 1) {
            $signals = Signal::where('id', '>', $request->id)->where('signal_type', '=', 1)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $signals], 200);
        } else {
            $signals = Signal::where('id', '>', $request->id)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $signals], 200);
        }
        // if(!empty($request->id) and !empty($request->user_choice)) {
        //     // $signals = Signal::where('id' , '>', $request->id)->orderBy('created_at','desc')->get();
        //     $signals = Signal::where('id' , '>', $request->id)->where('signal_type','=',$request->user_choice)->orderBy('created_at','desc')->get();
        //     return response()->json(['data' => $signals], 200);
        // } else {
        //     return response()->json(['data' => array() ], 200);
        // }
    }



    public function new_prediction_ideas(Request $request)
    {
        if ($request->user_choice == 0) {
            $predictionideas = PredictionIdeas::where('id', '>', $request->id)->where('prediction_type', '=', 0)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $predictionideas], 200);
        } else if ($request->user_choice == 1) {
            $predictionideas = PredictionIdeas::where('id', '>', $request->id)->where('prediction_type', '=', 1)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $predictionideas], 200);
        } else {
            $predictionideas = PredictionIdeas::where('id', '>', $request->id)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $predictionideas], 200);
        }
        // return $request;
        // if(!empty($request->id) and !empty($request->user_choice)) {
        //     // return 'Yes';
        //     $predictionideas = PredictionIdeas::where('id' , '>', $request->id)->where('prediction_type','=',$request->user_choice)->orderBy('created_at','desc')->get();
        //     return response()->json(['data' => $predictionideas], 200);
        // } else {
        //     return response()->json(['data' => array() ], 200);
        // }
    }
    public function new_trading_tips(Request $request)
    {
        if (!empty($request->id)) {
            $tradingtips = TradingTips::where('id', '>', $request->id)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $tradingtips], 200);
        } else {
            return response()->json(['data' => array()], 200);
        }
    }
    public function forex_signals(Request $request)
    {
        $signals = Signal::where('signal_type', 1)->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $signals], 200);
    }

    public function forex_prediction(Request $request)
    {
        $predictionideas = PredictionIdeas::where('prediction_type', 1)->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $predictionideas], 200);
    }

    public function crypto_signals(Request $request)
    {
        $signals = Signal::where('signal_type', 0)->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $signals], 200);
    }

    public function crypto_prediction(Request $request)
    {
        $predictionideas = PredictionIdeas::where('prediction_type', 0)->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $predictionideas], 200);
    }
    public function daily_news_add()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['data' => $news], 200);
    }

    public function technical_analysis(Request $request)
    {
        $technical_analysis = Market_education::where('id', 1)->first()->technical_analysis;
        return response()->json(['data' => $technical_analysis], 200);
    }

    public function trading_tips()
    {
        $trading_tips = TradingTips::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $trading_tips], 200);
    }
    public function fundamental_analysis(Request $request)
    {
        $technical_analysis = Market_education::where('id', 1)->first()->fundamental_analysis;
        return response()->json(['data' => $technical_analysis], 200);
    }

    public function forex_brokers_ranking(Request $request)
    {
        $forex_brokers_ranking = General_option::where('meta_key', 'forex_brokers_ranking')->first()->meta_value;
        return response()->json(['data' => $forex_brokers_ranking], 200);
    }

    public function crypto_brokers_ranking(Request $request)
    {
        $crypto_brokers_ranking = General_option::where('meta_key', 'crypto_brokers_ranking')->first()->meta_value;
        return response()->json(['data' => $crypto_brokers_ranking], 200);
    }

    public function terms_and_conditions(Request $request)
    {
        $terms_and_conditions = General_option::where('meta_key', 'terms_and_conditions')->first()->meta_value;
        return response()->json(['data' => $terms_and_conditions], 200);
    }
    public function gain_profits_add(Request $request)
    {
        date_default_timezone_set('Asia/Karachi');
        // return $request;
        if ($request->hasFile('image')) {

            //get filename with extension
            $filenamewithextension = $request->file('image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // return $extension;
            if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "jpeg" && $extension != "heic") {
                return response()->json(['error' => 'This file format not except']);
            } else {
                // echo 'No';
                $filenametostore = $filename . '_' . time() . '.' . $extension;

                $request->file('image')->move(public_path('assets/uploads'), $filenametostore);

                $url = asset('assets/uploads/' . $filenametostore);

                $gain_profits = new GainProfit();
                $gain_profits->device_id = $request->device_id;
                $gain_profits->user_choice = $request->user_choice;
                $gain_profits->image = $url;
                $gain_profits->created_at = date("Y-m-d H:i:s", strtotime('now'));
                $gain_profits->updated_at = date("Y-m-d H:i:s", strtotime('now'));
                $gain_profits->save();
                return response()->json(['success' => 'Thanks for your post!it will publish soon as possible!']);
            }
        } else {
            return response()->json(['error' => 'Image Required']);
        }
    }

    public function gain_profits_show(Request $request)
    {
        if ($request->status == 2) {
            $gain_profits = GainProfit::where('user_choice', $request->user_choice)->where('status', $request->status)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $gain_profits]);
        }
    }

    public function gain_profit_latest(Request $request)
    {
        if ($request->user_choice == 0) {
            $gain_profits = GainProfit::where('id', '>', $request->id)->where('user_choice', '=', 0)->where('status', 2)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $gain_profits], 200);
        } else if ($request->user_choice == 1) {
            $gain_profits = GainProfit::where('id', '>', $request->id)->where('user_choice', '=', 1)->where('status', 2)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $gain_profits], 200);
        } else {
            $gain_profits = GainProfit::where('id', '>', $request->id)->where('status', 2)->orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $gain_profits], 200);
        }
    }


    public function support(Request $request)
    {
        $phone_number = General_option::where('meta_key', 'phone_number')->first()->meta_value;
        $support_email = General_option::where('meta_key', 'support_email')->first()->meta_value;
        return response()->json(['data' => array('phone_number' => $support_email, 'support_email' => $support_email)], 200);
    }
}
