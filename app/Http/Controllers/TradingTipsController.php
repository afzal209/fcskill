<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Fcm_token;
use Carbon\Carbon;
use App\Models\TradingTips;
use Illuminate\Http\Request;

class TradingTipsController extends Controller
{
    public function index()
    {
        $tradingtips = TradingTips::orderBy('created_at', 'desc')->get();
        return view('tradingtips', compact('tradingtips'));
    }

    public function add()
    {
        return view("addTradingTips");
    }

    public function store(Request $request)
    {

        date_default_timezone_set('Asia/Karachi');

        $this->validate($request, [
            'trading_text' => 'required',
            'trading_type' => 'required',
        ]);

        $TradingTips = new TradingTips;
        $Notification = new Notification;

        $TradingTips->trading_text = $request->trading_text;
        $TradingTips->created_at = date("Y-m-d H:i:s", strtotime('now'));
        $TradingTips->updated_at = date("Y-m-d H:i:s", strtotime('now'));

        if (!empty($request->trading_type)) {
            $TradingTips->trading_type = 1;
            $Notification->notification_text = "New Trading Tips has been added";
            $Notification->signal_type = 1;
        } else {
            $TradingTips->trading_type = 0;
            $Notification->notification_text = "New Trading Tips has been added";
            $Notification->signal_type = 0;
        }

        $TradingTips->save();
        // $data = $Signal->signal_type;
        // $data = [
        //     'signal_text' => $Signal->signal_text,
        //     'signal_type' => $Signal->signal_type,
        // ];
        $data = Fcm_token::join('app_settings', 'fcm_tokens.device_id', 'app_settings.device_id')->where('tips_status', 1)->get();
        // return $data;
        foreach ($data as $value) {
            if ($value->tips_status) {
                $Notification->signal_id = $insertedId = $TradingTips->id;
                $Notification->save();

                if (!empty($request->trading_type)) {
                    $tokens = Fcm_token::pluck('fcm_token')->toArray();
                    $res = $this->send_push("Trading Tips", "New Trading Tips has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
                } else {
                    $tokens = Fcm_token::where('user_choice', '!=', 0)->pluck('fcm_token')->toArray();
                    $res = $this->send_push('Trading Tips', "New Trading Tips has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
                }
            }
        }
        // return response()->json(['doneMessage' => 'Signal Added!','data' => $data]);
        return redirect()->back()->with('doneMessage', 'Trading Tips Added!');
    }

    public function edit($id)
    {

        $tradingtips = TradingTips::find($id);

        if ($tradingtips) {
            return view("editTradingTips", compact("tradingtips"));
        } else {
            return redirect('tradingtips');
        }
    }


    public function update(Request $request, $id)
    {

        date_default_timezone_set('Asia/Karachi');

        $TradingTips = TradingTips::find($id);

        if ($TradingTips) {

            $this->validate($request, [
                'trading_text' => 'required',
                'trading_type' => 'required',
            ]);

            $TradingTips->trading_text = $request->trading_text;
            $TradingTips->updated_at = date("Y-m-d H:i:s", strtotime('now'));

            if (!empty($request->trading_type)) {
                $TradingTips->trading_type = 1;
            } else {
                $TradingTips->trading_type = 0;
            }

            if (!empty($request->status)) {
                $TradingTips->status = 0;
            } else {
                $TradingTips->status = 1;
            }

            $TradingTips->save();

            return redirect()->back()->with('doneMessage', 'Edit Done!');
        } else {
            return redirect('tradingtips');
        }
    }

    public function destroy($id)
    {
        $TradingTips = TradingTips::find($id);
        if ($TradingTips) {
            $TradingTips->delete();
            return redirect()->back()->with('doneMessage', 'Trading Deleted');
        } else {
            return redirect()->back()->with('doneMessage', 'Trading Not Exist!');
        }
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('assets/uploads'), $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/uploads/' . $filenametostore);
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
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 2);

        $data = array(
            'message'      => 'here is a message. message',
            'title'        => $title,
            'body'         => $body,
            'smallIcon'    => 'small_icon',
            'some data'    => 'Some Data',
            'Another Data' => 'Another Data'
        );

        $data2 = array(
            'date' => $date,
            'mobile_application_name' => $mobile_application_name,
            'type' => '2',
        );

        $arrayToSend = array(
            'registration_ids' => $tokens,
            //  'registration_ids' => array('e4TBt7IjQaq_rXUy4xo95H:APA91bHOfp3AVsPxnkN_7POipP82xAtFcICj5kUjuCFtDQsMLsJeBDWlslD2bSigup_G_k2qCwt3t1pAabDQTo9wfysugzrMZkqqHKoTdYv_EjC9TPnY5O1Wrcw72CljV2b2f4QYiEAM'),
            'notification' => $data,
            'data' => $data2,
            'priority' => 'high'
        );

        $json = json_encode($arrayToSend);

        // AIzaSyAmt7PRDsvu64bljAEjkAp46NDveSvbqGM

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AAAAjnWUSGA:APA91bHHbXjwK4qGxigeKhmIOOja4UDNKr26e-1F85xATfqMSm1oRf1x5LHwjZBhHRXduGAhG_H-GdEpwq0Iwl3ykEHHwnJ-UIeqAIG88HZ876EW6bhMedLKX3r7VN8sYT1dre2JvfQx';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
