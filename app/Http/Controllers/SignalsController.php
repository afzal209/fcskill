<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;
use App\Models\Notification;
use App\Models\Fcm_token;
use App\Models\Signal_User;
use App\Models\NotificationStatus;
use App\Models\AppSetting;
use App\Models\User;
use Carbon\Carbon;

class SignalsController extends Controller
{
    public function index()
    {
        // $signal;
        if (auth()->user()->user_role == 1) {
            # code...
            $signals = Signal::orderBy('created_at', 'desc')->get();
        }
        else{
            // $signals;
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                // echo 'TEst';
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',2); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    # code...
                    return redirect('/admin/no_access');
                }
                else{
                    if (auth()->user()->signal_type == 0) {
                         $signals = Signal::where('signal_type', 0)->orderBy('created_at', 'desc')->get();
                    }
                    elseif(auth()->user()->signal_type == 1){
                        $signals = Signal::where('signal_type',1)->orderBy('created_at', 'desc')->get();
                    }
                    else{
                        $signals = Signal::orderBy('created_at', 'desc')->get();   
                    }
                }
                // foreach($permission as $value){
                //     if ($value->permission_id == 2) {
                //         if (auth()->user()->signal_type == 0) {
                //             $signals = Signal::where('signal_type', 0)->orderBy('created_at', 'desc')->get();
                //         }
                //         elseif(auth()->user()->signal_type == 1){
                //             $signals = Signal::where('signal_type',1)->orderBy('created_at', 'desc')->get();
                //         }
                //         else{
                //             $signals = Signal::orderBy('created_at', 'desc')->get();
            
                //         }
                //         return view('signals', compact('signals'));

                //     }
                //     else{
                //         return redirect('/admin/no_access');
                //     }
                    
                // }
            }
        }
        return view('signals', compact('signals'));

        
        
    }


    public function add()
    {
        if (auth()->user()->user_role == 1) {
            # code...
            return view("addSignal");
        }
        else{
            // $signals;
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                // echo 'TEst';
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',2); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    # code...
                    return redirect('/admin/no_access');
                }
                else{
                    return view("addSignal");
                }
            }
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->user_role == 1) {
            # code...
            date_default_timezone_set('Asia/Karachi');

            $this->validate($request, [
                'signal_text' => 'required',
                'signal_type' => 'required',
            ]);
    
            $Signal = new Signal;
            $Notification = new Notification;
            $NotificationStatus = new NotificationStatus;
            // $Signal_user = new Signal_User;
            $Signal->signal_text = $request->signal_text;
            $Signal->created_at = date("Y-m-d H:i:s", strtotime('now'));
            $Signal->updated_at = date("Y-m-d H:i:s", strtotime('now'));
    
            if (!empty($request->signal_type)) {
    
                $Signal->signal_type = 1;
                $Notification->notification_text = "New forex signal has been added";
                $Notification->signal_type = 1;
              
            } else {
                $Signal->signal_type = 0;
                $Notification->notification_text = "New crypto signal has been added";
                $Notification->signal_type = 0;
            }
            
                if (!empty($request->signal_type)) {
                    // $Signal_user = Signal_User::where('signal_type','=',0)->get();
                    $signal_users = Signal_User::where('signal_type','!=', 0)->whereNotNull('device_id')->pluck('device_id')->toArray();
                    // return $signal_users;
                    $res = $this->send_push('Forex Signal', "New forex signal has been added. Click to view.", $signal_users, date('Y-m-d'), 'Fcskill');
    
                    
                } else{
                    //dd(Signal_User::where('signal_type',1)->get('id'));
                    $signal_users = Signal_User::where('signal_type','!=', 1)->whereNotNull('device_id')->pluck('device_id')->toArray();
                    $res = $this->send_push('Crypto Signal', "New crypto signal has been added. Click to view.", $signal_users, date('Y-m-d'), 'Fcskill');
                }
            
    
            $Signal->save();
            $data = $Signal->signal_type;
            $Notification->signal_id = $insertedId = $Signal->id;
    
            $Notification->save();
    
    
            if (!empty($request->signal_type)) {
    
                
    
                $tokens = Fcm_token::where('user_choice', '!=', 1)->where('signals_notif',1)->pluck('fcm_token')->toArray();
    
                $res = $this->send_push("Forex Signal", "New forex signal has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
    
               
            } else {
              
                $tokens = Fcm_token::where('user_choice', '!=', 0)->where('signals_notif',1)->pluck('fcm_token')->toArray();
                $res = $this->send_push('Crypto Signal', "New crypto signal has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
    
                     
            }
    
    
            return response()->json(['doneMessage' => 'Signal Added!', 'data' => $data]);
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return response()->json(['access' => 1]);
            }
            else{
                // echo 'TEst';
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',2); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    return response()->json(['access' => 1]);
                }
                else{
                    date_default_timezone_set('Asia/Karachi');

                    $this->validate($request, [
                        'signal_text' => 'required',
                        'signal_type' => 'required',
                    ]);
            
                    $Signal = new Signal;
                    $Notification = new Notification;
                    $NotificationStatus = new NotificationStatus;
                    // $Signal_user = new Signal_User;
                    $Signal->signal_text = $request->signal_text;
                    $Signal->created_at = date("Y-m-d H:i:s", strtotime('now'));
                    $Signal->updated_at = date("Y-m-d H:i:s", strtotime('now'));
            
                    if (!empty($request->signal_type)) {
            
                        $Signal->signal_type = 1;
                        $Notification->notification_text = "New forex signal has been added";
                        $Notification->signal_type = 1;
                    
                    } else {
                        $Signal->signal_type = 0;
                        $Notification->notification_text = "New crypto signal has been added";
                        $Notification->signal_type = 0;
                    }
            
                    if (!empty($request->signal_type)) {
                        // $Signal_user = Signal_User::where('signal_type','=',0)->get();
                        $signal_users = Signal_User::where('signal_type','!=', 0)->whereNotNull('device_id')->pluck('device_id')->toArray();
                        // return $signal_users;
                        $res = $this->send_push('Forex Signal', "New forex signal has been added. Click to view.", $signal_users, date('Y-m-d'), 'Fcskill');
        
                        
                    } else{
                        //dd(Signal_User::where('signal_type',1)->get('id'));
                        $signal_users = Signal_User::where('signal_type','!=', 1)->whereNotNull('device_id')->pluck('device_id')->toArray();
                        $res = $this->send_push('Crypto Signal', "New crypto signal has been added. Click to view.", $signal_users, date('Y-m-d'), 'Fcskill');
                    }
            
    
                    $Signal->save();
                    $data = $Signal->signal_type;
                    $Notification->signal_id = $insertedId = $Signal->id;
            
                    $Notification->save();
            
            
                    if (!empty($request->signal_type)) {
            
                        
            
                        $tokens = Fcm_token::where('user_choice', '!=', 1)->where('signals_notif',1)->pluck('fcm_token')->toArray();
            
                        $res = $this->send_push("Forex Signal", "New forex signal has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
            
                    
                    } else {
                    
                        $tokens = Fcm_token::where('user_choice', '!=', 0)->where('signals_notif',1)->pluck('fcm_token')->toArray();
                        $res = $this->send_push('Crypto Signal', "New crypto signal has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');
            
                            
                    }
            
            
                        return response()->json(['doneMessage' => 'Signal Added!', 'data' => $data]);
                }
            }
        }

        
        // return redirect()->back()->with('doneMessage', 'Signal Added!');
    }

    public function edit($id)
    {

        if (auth()->user()->user_role == 1) {
            # code...
            $signal = Signal::find($id);

            if ($signal) {
                return view("editSignal", compact("signal"));
            } else {
                return redirect('signals');
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
                // echo 'TEst';
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',2); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    # code...
                    return redirect('/admin/no_access');
                }
                else{
                    $signal = Signal::find($id);

                    if ($signal) {
                        return view("editSignal", compact("signal"));
                    } else {
                        return redirect('signals');
                    }
                }
            }
        }
        
    }


    public function update(Request $request, $id)
    {
        if (auth()->user()->user_role == 1) {
            date_default_timezone_set('Asia/Karachi');

            $Signal = Signal::find($id);

            if ($Signal) {

                $this->validate($request, [
                    'signal_text' => 'required',
                    'signal_type' => 'required',
                ]);

                $Signal->signal_text = $request->signal_text;
                $Signal->updated_at = date("Y-m-d H:i:s", strtotime('now'));

                if (!empty($request->signal_type)) {
                    $Signal->signal_type = 1;
                } else {
                    $Signal->signal_type = 0;
                }

                if (!empty($request->status)) {
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
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                // echo 'TEst';
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',2); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    # code...
                    return redirect('/admin/no_access');
                }
                else{
                    date_default_timezone_set('Asia/Karachi');

                    $Signal = Signal::find($id);

                    if ($Signal) {

                        $this->validate($request, [
                            'signal_text' => 'required',
                            'signal_type' => 'required',
                        ]);

                        $Signal->signal_text = $request->signal_text;
                        $Signal->updated_at = date("Y-m-d H:i:s", strtotime('now'));

                        if (!empty($request->signal_type)) {
                            $Signal->signal_type = 1;
                        } else {
                            $Signal->signal_type = 0;
                        }

                        if (!empty($request->status)) {
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
            }
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->user_role == 1) {
            $Signal = Signal::find($id);
            if ($Signal) {
                $Signal->delete();
                return redirect()->back()->with('doneMessage', 'Signal Deleted');
            } else {
                return redirect()->back()->with('doneMessage', 'Signal Not Exist!');
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
                // echo 'TEst';
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',2); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    # code...
                    return redirect('/admin/no_access');
                }
                else{
                    $Signal = Signal::find($id);
                    if ($Signal) {
                        $Signal->delete();
                        return redirect()->back()->with('doneMessage', 'Signal Deleted');
                    } else {
                        return redirect()->back()->with('doneMessage', 'Signal Not Exist!');
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
            'Another Data' => 'Another Data',
            'click_action' => 'http://127.0.0.1:8000/signal-type',
        );

        $data2 = array(
            'date' => $date,
            'mobile_application_name' => $mobile_application_name,
            'type' => '0',
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
        $headers[] = 'Authorization: key= AAAAlB11lRU:APA91bHdD_XofjKL_3CCCIvlR9mUpAPlSCWJHJTDi0DM93ZE7qYlOHe8EjZPoPzAXA4fjXBRP1qKu8sifE0-5AC2RcuBaR-ukryeR-fyrDambhsH6KtxWAPCiAcmEDBnYUPlYo4TVNCU';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
