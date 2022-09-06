<?php

namespace App\Http\Controllers;
use App\Models\PredictionIdeas;
use App\Models\Notification;
use App\Models\Fcm_token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PredictionIdeasController extends Controller
{
    //
    public function index(){
        $predictionideas = PredictionIdeas::orderBy('created_at','desc')->get();
        return view('predictionideas', compact('predictionideas'));
    }

    public function add(){
        return view("addPredictionIdeas");
    }

    public function store(Request $request){

        date_default_timezone_set('Asia/Karachi');

        $this->validate($request,[
            'prediction_text' => 'required',
            'prediction_type' => 'required',
        ]);

        $PredictionIdeas = new PredictionIdeas;
        $Notification = new Notification;

        $PredictionIdeas->prediction_text = $request->prediction_text;
        $PredictionIdeas->created_at = date("Y-m-d H:i:s", strtotime('now'));
        $PredictionIdeas->updated_at = date("Y-m-d H:i:s", strtotime('now'));

        if(!empty($request->prediction_type)) {
            $PredictionIdeas->prediction_type = 1;
            $Notification->notification_text = "New forex prediction has been added";
            $Notification->signal_type = 1;
        } else {
            $PredictionIdeas->prediction_type = 0;
            $Notification->notification_text = "New crypto prediction has been added";
            $Notification->signal_type = 0;
        }

        $PredictionIdeas->save();
         // $data = $Signal->signal_type;
        // $data = [
        //     'signal_text' => $Signal->signal_text,
        //     'signal_type' => $Signal->signal_type,
        // ];
        $Notification->signal_id = $insertedId = $PredictionIdeas->id;
        $Notification->save();
        
        if(!empty($request->prediction_type)) {
            $tokens = Fcm_token::where('user_choice' , '!=', 1)->pluck('fcm_token')->toArray();
           $res = $this->send_push("Forex Prediction", "Forex prediction has been added. Click to view.", $tokens, date('Y-m-d') ,'Fcskill');
        } else {
            $tokens = Fcm_token::where('user_choice' , '!=', 0)->pluck('fcm_token')->toArray();
            $res = $this->send_push('Crypto Prediction', "Crypto prediction has been adde. Click to view.", $tokens, date('Y-m-d') , 'Fcskill');
        }
        // return response()->json(['doneMessage' => 'Signal Added!','data' => $data]);
        return redirect()->back()->with('doneMessage', 'Prediction Ideas Added!');
    }

    public function edit($id){

        $predictionideas = PredictionIdeas::find($id);

        if ($predictionideas) {
            return view("editPredictionIdeas", compact("predictionideas"));
        } else {
            return redirect('predictionideas');
        }
    }


    public function update(Request $request, $id){

        date_default_timezone_set('Asia/Karachi');

        $PredictionIdeas = PredictionIdeas::find($id);

        if($PredictionIdeas){

            $this->validate($request, [
                'prediction_text' => 'required',
                'prediction_type' => 'required',
            ]);

            $PredictionIdeas->prediction_text = $request->prediction_text;
            $PredictionIdeas->updated_at = date("Y-m-d H:i:s", strtotime('now'));

            if(!empty($request->prediction_type)) {
                $PredictionIdeas->prediction_type = 1;
            } else {
                $PredictionIdeas->prediction_type = 0;
            }

            if(!empty($request->status)) {
                $PredictionIdeas->status = 0;
            } else {
                $PredictionIdeas->status = 1;
            }

            $PredictionIdeas->save();

            return redirect()->back()->with('doneMessage', 'Edit Done!');
        } else {
            return redirect('predictionideas');
        }

    }

    public function destroy($id)
    {
        $PredictionIdeas = PredictionIdeas::find($id);
        if ($PredictionIdeas) {
            $PredictionIdeas->delete();
            return redirect()->back()->with('doneMessage', 'Signal Deleted');
        } else {
            return redirect()->back()->with('doneMessage', 'Signal Not Exist!');
        }
    }


    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {

            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('assets/uploads'), $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;

        }
    }

    public function send_push($title, $body, $tokens, $date, $mobile_application_name)
    {
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, 2 );

        $data = array(
            'message'      => 'here is a message. message',
            'title'        => $title,
            'body'         => $body,
            'smallIcon'    => 'small_icon',
            'some data'    => 'Some Data',
            'Another Data' => 'Another Data'
        );

        $data2=array(
            'date' => $date,
            'mobile_application_name' => $mobile_application_name
        );

        $arrayToSend = array(
         'registration_ids' => $tokens,
        //  'registration_ids' => array('e4TBt7IjQaq_rXUy4xo95H:APA91bHOfp3AVsPxnkN_7POipP82xAtFcICj5kUjuCFtDQsMLsJeBDWlslD2bSigup_G_k2qCwt3t1pAabDQTo9wfysugzrMZkqqHKoTdYv_EjC9TPnY5O1Wrcw72CljV2b2f4QYiEAM'),
         'notification' => $data,
         'data' => $data2,
         'priority'=>'high'
     );

        $json = json_encode($arrayToSend);

        // AIzaSyAmt7PRDsvu64bljAEjkAp46NDveSvbqGM

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AAAAstDbIp4:APA91bFE11r15K6RirAGXPTPIdOLeZxuzXzI_6h6_F6BaUzteVqanFt-j9m32MXqS0qan6AAPkgCuMc3KKjrd5Uc9ZWszpm4a-knNQYcMaekG0XjelEzNCHcLHrsfSslSs1D9Kb-Zz2m';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}