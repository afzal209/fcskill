<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;
use App\Models\Market_education;
use App\Models\General_option;
use App\Models\Fcm_token;
use App\Models\News;
use App\Models\PredictionIdeas;
use App\Models\TradingTips;

class ApiController extends Controller
{

    public function add_fcm_token(Request $request)
    {
        if (Fcm_token::where('device_id', $request->device_id)->exists()) {

            $fcm_token = Fcm_token::where('device_id' , '=', $request->device_id)->first();

            $fcm_token->device_id = $request->device_id;
            $fcm_token->choice = $request->user_choice;
            $fcm_token->fcm_token = $request->fcm_token;
            $fcm_token->save();

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

    public function signals(Request $request)
    {
        $signals = Signal::orderBy('created_at','desc')->get();
        return response()->json(['data' => $signals], 200);
    }
    // for web
    public function signal_check($type){
        if($type == 0){
            $signal_check = Signal::where('signal_type',0)->orderBy('created_at','desc')->paginate(10);
        }
        else if($type == 1){
            $signal_check = Signal::where('signal_type',1)->orderBy('created_at','desc')->paginate(10);
        }
        else{
            $signal_check = Signal::orderBy('created_at','desc')->paginate(10);
        }
        return response()->json(['data' => $signal_check],200);
        
    }
    public function prediction_ideas(Request $request){
        // return $request;
        $prediction_ideas = PredictionIdeas::orderBy('created_at','desc')->get();
        return response()->json(['data' => $prediction_ideas],200); 
    }
    public function web_setting($text){
        return $text;
        // $web_setting_get = User::where('id',$id)->first();
        // return response()->json(['data',$web_setting_get]);
    }

    public function new_signals(Request $request)
    {
        if(!empty($request->id)) {
            $signals = Signal::where('id' , '>', $request->id)->orderBy('created_at','desc')->get();
            return response()->json(['data' => $signals], 200);
        } else {
            return response()->json(['data' => array() ], 200);
        }
    }

    public function check_notify_signal(Request $request){
        return $request->id;
        // $signal_notify = Signal::find($id);
        // return $signal_check;
    }

    public function new_prediction_ideas(Request $request)
    {
        if(!empty($request->id)) {
            $predictionideas = PredictionIdeas::where('id' , '>', $request->id)->where('prediction_type','=',$request->user_choice)->orderBy('created_at','desc')->get();
            return response()->json(['data' => $predictionideas], 200);
        } else {
            return response()->json(['data' => array() ], 200);
        }
    }
     public function new_trading_tips(Request $request)
    {
        if(!empty($request->id)) {
            $tradingtips = TradingTips::where('id' , '>', $request->id)->orderBy('created_at','desc')->get();
            return response()->json(['data' => $tradingtips], 200);
        } else {
            return response()->json(['data' => array() ], 200);
        }
    }
    public function forex_signals(Request $request)
    {
        $signals = Signal::where('signal_type', 1)->orderBy('created_at','desc')->get();
        return response()->json(['data' => $signals], 200);
    }

    public function forex_prediction(Request $request)
    {
        $predictionideas = PredictionIdeas::where('prediction_type', 1)->orderBy('created_at','desc')->get();
        return response()->json(['data' => $predictionideas], 200);
    }

    public function crypto_signals(Request $request)
    {
        $signals = Signal::where('signal_type', 0)->orderBy('created_at','desc')->get();
        return response()->json(['data' => $signals], 200);
    }

    public function crypto_prediction(Request $request)
    {
        $predictionideas = PredictionIdeas::where('prediction_type', 0)->orderBy('created_at','desc')->get();
        return response()->json(['data' => $predictionideas], 200);
    }
    public function daily_news_add(){
        $news = News::orderBy('created_at','desc')->paginate(5);
        return response()->json(['data' => $news],200);
    }

    public function technical_analysis(Request $request)
    {
        $technical_analysis = Market_education::where('id', 1)->first()->technical_analysis;
        return response()->json(['data' => $technical_analysis], 200);
    }

    public function trading_tips(){
        $trading_tips = TradingTips::orderBy('created_at','desc')->get();
        return response()->json(['data' => $trading_tips],200); 
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

    public function support(Request $request)
    {
        $phone_number = General_option::where('meta_key', 'phone_number')->first()->meta_value;
        $support_email = General_option::where('meta_key', 'support_email')->first()->meta_value;
        return response()->json(['data' => array('phone_number' => $support_email, 'support_email' => $support_email ) ], 200);
    }


}