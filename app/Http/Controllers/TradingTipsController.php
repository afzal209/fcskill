<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Fcm_token;
use Carbon\Carbon;
use App\Models\TradingTips;
use App\Models\AppSetting;
use DateTime;
use App\Models\User;
use Illuminate\Http\Request;


class TradingTipsController extends Controller
{
    public function index()
    {
        if (auth()->user()->user_role == 1) {
            # code...
            $tradingtips = TradingTips::orderBy('created_at', 'desc')->get();
            return view('tradingtips', compact('tradingtips'));
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',4); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    // dd('No');
                    if (auth()->user()->signal_type == 0) {
                        $tradingtips = TradingTips::where('trading_type',0)->orderBy('created_at', 'desc')->get();
                    }
                    elseif (auth()->user()->signal_type == 1) {
                        $tradingtips = TradingTips::where('trading_type',1)->orderBy('created_at', 'desc')->get();
                    }else{
                        $tradingtips = TradingTips::orderBy('created_at', 'desc')->get();
                    }
                    return view('tradingtips', compact('tradingtips'));

                }
            }
        }
            
        
    }

    public function add()
    {
        if (auth()->user()->user_role == 1) {
            return view("addTradingTips");
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',4); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    return view("addTradingTips");
                }
            }
        }
    }

    public function store(Request $request)
    {

        if (auth()->user()->user_role == 1) {
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
                $Notification->notification_text = "New Update has been added";
                $Notification->signal_type = 1;
            } else {
                $TradingTips->trading_type = 0;
                $Notification->notification_text = "New Update has been added";
                $Notification->signal_type = 0;
            }

            $TradingTips->save();
            $Notification->signal_id = $insertedId = $TradingTips->id;
            $Notification->save();

            if (!empty($request->trading_type)) {

                // $tokens = Fcm_token::where('user_choice', '!=', 1)->select('fcm_token', 'device_id')->get();
                // foreach ($tokens as $tok) {
                //     // print_r($tok->device_id);
                //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                //         $app_setting = AppSetting::where('device_id', $tok->device_id)->select('device_id', 'fcm_token')->where('tips_status', 1)->get();
                //         foreach ($app_setting as $app) {
                //             // echo 'Exist';
                //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();
                //             // echo '<pre>'.print_r($check_token).'</pre>';
                //             $res = $this->send_push("Latest Update", "New Update has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                //         }
                //     } else {
                //         // echo 'Not Exist';
                        $tokens = Fcm_token::where('user_choice', '!=', 1)->where('updates_notif',1)->pluck('fcm_token')->toArray();
                        $res = $this->send_push("Latest Update", "New Update has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
                        // echo '<pre>'.print_r($fcm).'</pre>';
                //     }
                // }
            } else {

                // $tokens = Fcm_token::where('user_choice', '!=', 0)->select('fcm_token', 'device_id')->get();
                // foreach ($tokens as $tok) {
                //     // print_r($tok->device_id);
                //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                //         // echo 'Yes';
                //         $app_setting = AppSetting::where('device_id', $tok->device_id)->select('device_id', 'fcm_token')->where('tips_status', 1)->get();
                //         // $current_date_time = Carbon::now()->timestamp;
                //         foreach ($app_setting as $app) {
                //             //             // echo 'Exist';
                //             // echo 'Exist';
                //             // print_r($app->device_id);
                //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();
                //             // echo '<pre>'.print_r($check_token).'</pre>';
                //             // // // //                 // $tokens = Fcm_token::where('user_choice', '!=', 1)->pluck('fcm_token')->toArray();
                //             $res = $this->send_push('Latest Update', "New Update has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                //         }
                //     } else {
                //         // echo 'No';
                //         // echo 'Not Exist';

                        //         // echo 'Not Exist';
                        $tokens = Fcm_token::where('user_choice', '!=', 0)->where('updates_notif',1)->pluck('fcm_token')->toArray();
                        $res = $this->send_push('Latest Update', "New Update has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');

                        // echo '<pre>'.print_r($fcm).'</pre>';
                //     }
                // }
                // $endTime = Carbon::now()->timestamp;
                // $total = $endTime - $current_date_time;
                // $data = Carbon::createFromTimestamp($total)->toDateTimeString();
                // dd($data);
            }
            // }
            // }
            // return response()->json(['doneMessage' => 'Signal Added!','data' => $data]);
            return redirect()->back()->with('doneMessage', 'Latest Update Added!');
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',4); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
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
                        $Notification->notification_text = "New Update has been added";
                        $Notification->signal_type = 1;
                    } else {
                        $TradingTips->trading_type = 0;
                        $Notification->notification_text = "New Update has been added";
                        $Notification->signal_type = 0;
                    }

                    $TradingTips->save();
                    $Notification->signal_id = $insertedId = $TradingTips->id;
                    $Notification->save();

                    if (!empty($request->trading_type)) {

                        // $tokens = Fcm_token::where('user_choice', '!=', 1)->select('fcm_token', 'device_id')->get();
                        // foreach ($tokens as $tok) {
                        //     // print_r($tok->device_id);
                        //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                        //         $app_setting = AppSetting::where('device_id', $tok->device_id)->select('device_id', 'fcm_token')->where('tips_status', 1)->get();
                        //         foreach ($app_setting as $app) {
                        //             // echo 'Exist';
                        //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();
                        //             // echo '<pre>'.print_r($check_token).'</pre>';
                        //             $res = $this->send_push("Latest Update", "New Update has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                        //         }
                        //     } else {
                        //         // echo 'Not Exist';
                                $tokens = Fcm_token::where('user_choice', '!=', 1)->where('updates_notif',1)->pluck('fcm_token')->toArray();
                                $res = $this->send_push("Latest Update", "New Update has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
                                // echo '<pre>'.print_r($fcm).'</pre>';
                        //     }
                        // }
                    } else {

                        // $tokens = Fcm_token::where('user_choice', '!=', 0)->select('fcm_token', 'device_id')->get();
                        // foreach ($tokens as $tok) {
                        //     // print_r($tok->device_id);
                        //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                        //         // echo 'Yes';
                        //         $app_setting = AppSetting::where('device_id', $tok->device_id)->select('device_id', 'fcm_token')->where('tips_status', 1)->get();
                        //         // $current_date_time = Carbon::now()->timestamp;
                        //         foreach ($app_setting as $app) {
                        //             //             // echo 'Exist';
                        //             // echo 'Exist';
                        //             // print_r($app->device_id);
                        //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();
                        //             // echo '<pre>'.print_r($check_token).'</pre>';
                        //             // // // //                 // $tokens = Fcm_token::where('user_choice', '!=', 1)->pluck('fcm_token')->toArray();
                        //             $res = $this->send_push('Latest Update', "New Update has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                        //         }
                        //     } else {
                        //         // echo 'No';
                        //         // echo 'Not Exist';

                                //         // echo 'Not Exist';
                                $tokens = Fcm_token::where('user_choice', '!=', 0)->where('updates_notif',1)->pluck('fcm_token')->toArray();
                                $res = $this->send_push('Latest Update', "New Update has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');

                                // echo '<pre>'.print_r($fcm).'</pre>';
                        //     }
                        // }
                        // $endTime = Carbon::now()->timestamp;
                        // $total = $endTime - $current_date_time;
                        // $data = Carbon::createFromTimestamp($total)->toDateTimeString();
                        // dd($data);
                    }
                    // }
                    // }
                    // return response()->json(['doneMessage' => 'Signal Added!','data' => $data]);
                    return redirect()->back()->with('doneMessage', 'Latest Update Added!');
                }
            }
        }
    }

    public function edit($id)
    {

        if (auth()->user()->user_role == 1) {
            $tradingtips = TradingTips::find($id);

            if ($tradingtips) {
                return view("editTradingTips", compact("tradingtips"));
            } else {
                return redirect('tradingtips');
            }
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',4); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $tradingtips = TradingTips::find($id);

                    if ($tradingtips) {
                        return view("editTradingTips", compact("tradingtips"));
                    } else {
                        return redirect('tradingtips');
                    }
                }
            }
        }
    }


    public function update(Request $request, $id)
    {
        if (auth()->user()->user_role == 1) {
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
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',4); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
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
            }
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->user_role == 1) {
            $TradingTips = TradingTips::find($id);
            if ($TradingTips) {
                $TradingTips->delete();
                return redirect()->back()->with('doneMessage', 'Trading Deleted');
            } else {
                return redirect()->back()->with('doneMessage', 'Trading Not Exist!');
            }
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',4); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $TradingTips = TradingTips::find($id);
                    if ($TradingTips) {
                        $TradingTips->delete();
                        return redirect()->back()->with('doneMessage', 'Trading Deleted');
                    } else {
                        return redirect()->back()->with('doneMessage', 'Trading Not Exist!');
                    }
                }
            }
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
