<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;
use App\Models\Notification;
use App\Models\Fcm_token;
use Carbon\Carbon;


class SignalsController extends Controller
{
   
    
    public function index()
    {
        $signals = Signal::orderBy('created_at','desc')->get();
        return view('signals', compact('signals'));
    }


    public function add(){
        return view("addSignal");
    }

    public function store(Request $request){

        date_default_timezone_set('Asia/Karachi');

        $this->validate($request,[
            'signal_text' => 'required',
            'signal_type' => 'required',
        ]);

        $Signal = new Signal;
        $Notification = new Notification;

        $Signal->signal_text = $request->signal_text;
        $Signal->created_at = date("Y-m-d H:i:s", strtotime('now'));
        $Signal->updated_at = date("Y-m-d H:i:s", strtotime('now'));

        if(!empty($request->signal_type)) {
            $Signal->signal_type = 1;
            $Notification->notification_text = "New forex signal has been added";
            $Notification->signal_type = 1;
        } else {
            $Signal->signal_type = 0;
            $Notification->notification_text = "New crypto signal has been added";
            $Notification->signal_type = 0;
        }

        $Signal->save();
        $data = $Signal->signal_type;
        // $data = [
        //     'signal_text' => $Signal->signal_text,
        //     'signal_type' => $Signal->signal_type,
        // ];
        $Notification->signal_id = $insertedId = $Signal->id;
        $Notification->save();
        
        if(!empty($request->signal_type)) {
            $tokens = Fcm_token::where('user_choice' , '!=', 1)->pluck('fcm_token')->toArray();
           $res = $this->send_push("Forex Signal", "New forex signal has been added. Click to view.", $tokens, date('Y-m-d') ,'Fcskill');
        } else {
            $tokens = Fcm_token::where('user_choice' , '!=', 0)->pluck('fcm_token')->toArray();
            $res = $this->send_push('Crypto Signal', "New crypto signal has been added. Click to view.", $tokens, date('Y-m-d') , 'Fcskill');
        }
        return response()->json(['doneMessage' => 'Signal Added!','data' => $data]);
        // return redirect()->back()->with('doneMessage', 'Signal Added!');
    }

    public function edit($id){

        $signal = Signal::find($id);

        if ($signal) {
            return view("editSignal", compact("signal"));
        } else {
            return redirect('signals');
        }
    }


    public function update(Request $request, $id){

        date_default_timezone_set('Asia/Karachi');

        $Signal = Signal::find($id);

        if($Signal){

            $this->validate($request, [
                'signal_text' => 'required',
                'signal_type' => 'required',
            ]);

            $Signal->signal_text = $request->signal_text;
            $Signal->updated_at = date("Y-m-d H:i:s", strtotime('now'));

            if(!empty($request->signal_type)) {
                $Signal->signal_type = 1;
            } else {
                $Signal->signal_type = 0;
            }

            if(!empty($request->status)) {
                $Signal->status = 0;
            } else {
                $Signal->status = 1;
            }

            $Signal->save();

            return redirect()->back()->with('doneMessage', 'Edit Done!');
        } else {
            return redirect('signals');
        }

    }

    public function destroy($id)
    {
        $Signal = Signal::find($id);
        if ($Signal) {
            $Signal->delete();
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
            'body'         => $body ,
            'smallIcon'    => 'small_icon',
            'some data'    => 'Some Data',
            'Another Data' => 'Another Data'
        );

        $data2=array(
            'date' => $date,
            'mobile_application_name' => $mobile_application_name,
            'type' => '0',           
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
        $headers[] = 'Authorization: key= AAAAjnWUSGA:APA91bHHbXjwK4qGxigeKhmIOOja4UDNKr26e-1F85xATfqMSm1oRf1x5LHwjZBhHRXduGAhG_H-GdEpwq0Iwl3ykEHHwnJ-UIeqAIG88HZ876EW6bhMedLKX3r7VN8sYT1dre2JvfQx';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}