<?php

namespace App\Http\Controllers;

use App\Models\PredictionIdeas;
use App\Models\Notification;
use App\Models\Fcm_token;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AppSetting;

use Illuminate\Http\Request;

class PredictionIdeasController extends Controller
{
    //
    public function index()
    {
        if (auth()->user()->user_role == 1) {
            # code...
            $predictionideas = PredictionIdeas::orderBy('created_at', 'desc')->get();
            return view('predictionideas', compact('predictionideas'));
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',3); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    return redirect('/admin/no_access');
                }
                else{
                    if (auth()->user()->signal_type == 0) {
                        $predictionideas = PredictionIdeas::where('prediction_type', 0)->orderBy('created_at', 'desc')->get();
                    }
                    elseif (auth()->user()->signal_type == 1) {
                        $predictionideas = PredictionIdeas::where('prediction_type', 1)->orderBy('created_at', 'desc')->get();
                    }
                    else{
                        $predictionideas = PredictionIdeas::orderBy('created_at', 'desc')->get();
                    }
                    return view('predictionideas', compact('predictionideas'));

                }
                
            }
            
            // $user = User::find(auth()->user()->id);
            // $permission = $user->user_has_permssion;
            // if ($permission == null) {
            //     return redirect('/admin/no_access');
            // }
            // else{
            // }

        }

    }

    public function add()
    {
        if (auth()->user()->user_role == 1) {
            return view("addPredictionIdeas");
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',3); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    return redirect('/admin/no_access');
                }
                else{
                    return view("addPredictionIdeas");
                }
            }
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->user_role == 1) {
            date_default_timezone_set('Asia/Karachi');

            $this->validate($request, [
                'prediction_text' => 'required',
                'prediction_type' => 'required',
            ]);

            $PredictionIdeas = new PredictionIdeas;
            $Notification = new Notification;

            $PredictionIdeas->prediction_text = $request->prediction_text;
            $PredictionIdeas->created_at = date("Y-m-d H:i:s", strtotime('now'));
            $PredictionIdeas->updated_at = date("Y-m-d H:i:s", strtotime('now'));

            if (!empty($request->prediction_type)) {
                $PredictionIdeas->prediction_type = 1;
                $Notification->notification_text = "New forex signal has been added";
                $Notification->signal_type = 1;
            } else {
                $PredictionIdeas->prediction_type = 0;
                $Notification->notification_text = "New crypto signal has been added";
                $Notification->signal_type = 0;
            }

            $PredictionIdeas->save();
            $Notification->signal_id = $insertedId = $PredictionIdeas->id;
            $Notification->save();
            if (!empty($request->prediction_type)) {
            
                // $tokens = Fcm_token::where('user_choice', '!=', 1)->get();
                // foreach ($tokens as $tok) {
                //     // print_r($tok->device_id);
                //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                //         $app_setting = AppSetting::where('device_id', $tok->device_id)->where('prediction_status', 1)->get();
                //         foreach ($app_setting as $app) {
                //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();

                //                 $res = $this->send_push("Forex Prediction", "Forex prediction has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                //         }
                //     }
                //     else{
                        $tokens = Fcm_token::where('user_choice', '!=', 1)->where('prediction_notif',1)->pluck('fcm_token')->toArray();
                        $res = $this->send_push("Forex Prediction", "Forex prediction has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');

                //     }
                // }
                
            } else {
                // $Notification->signal_id = $insertedId = $PredictionIdeas->id;
                // $Notification->save();
                // $tokens = Fcm_token::where('user_choice', '!=', 0)->get();
                // foreach ($tokens as $tok) {
                //     // print_r($tok->device_id);
                //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                //         // echo 'Yes';
                //         $app_setting = AppSetting::where('device_id', $tok->device_id)->where('prediction_status', 1)->get();
                //         foreach ($app_setting as $app) {
                //             //             // echo 'Exist';
                //             // print_r($app->device_id);
                //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();
                //             // print_r($check_token);
                //             // // //                 // $tokens = Fcm_token::where('user_choice', '!=', 1)->pluck('fcm_token')->toArray();
                //             $res = $this->send_push('Crypto Prediction', "Crypto prediction has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                //         }
                //     } else {
                //         // echo 'No';
                        //         // echo 'Not Exist';
                        $tokens = Fcm_token::where('user_choice', '!=', 0)->where('prediction_notif',1)->pluck('fcm_token')->toArray();
                        $res = $this->send_push('Crypto Prediction', "Crypto prediction has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');

                        // print_r($fcm);
                //     }
                // }
            
            }

            // return response()->json(['doneMessage' => 'Signal Added!','data' => $data]);
            return redirect()->back()->with('doneMessage', 'Prediction Ideas Added!');
        }
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',3); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    return redirect('/admin/no_access');
                }
                else{
                    date_default_timezone_set('Asia/Karachi');

                    $this->validate($request, [
                        'prediction_text' => 'required',
                        'prediction_type' => 'required',
                    ]);

                    $PredictionIdeas = new PredictionIdeas;
                    $Notification = new Notification;

                    $PredictionIdeas->prediction_text = $request->prediction_text;
                    $PredictionIdeas->created_at = date("Y-m-d H:i:s", strtotime('now'));
                    $PredictionIdeas->updated_at = date("Y-m-d H:i:s", strtotime('now'));

                    if (!empty($request->prediction_type)) {
                        $PredictionIdeas->prediction_type = 1;
                        $Notification->notification_text = "New forex signal has been added";
                        $Notification->signal_type = 1;
                    } else {
                        $PredictionIdeas->prediction_type = 0;
                        $Notification->notification_text = "New crypto signal has been added";
                        $Notification->signal_type = 0;
                    }

                    $PredictionIdeas->save();
                    $Notification->signal_id = $insertedId = $PredictionIdeas->id;
                    $Notification->save();
                    if (!empty($request->prediction_type)) {
                    
                        // $tokens = Fcm_token::where('user_choice', '!=', 1)->get();
                        // foreach ($tokens as $tok) {
                        //     // print_r($tok->device_id);
                        //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                        //         $app_setting = AppSetting::where('device_id', $tok->device_id)->where('prediction_status', 1)->get();
                        //         foreach ($app_setting as $app) {
                        //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();

                        //                 $res = $this->send_push("Forex Prediction", "Forex prediction has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                        //         }
                        //     }
                        //     else{
                                $tokens = Fcm_token::where('user_choice', '!=', 1)->where('prediction_notif',1)->pluck('fcm_token')->toArray();
                                $res = $this->send_push("Forex Prediction", "Forex prediction has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');

                        //     }
                        // }
                        
                    } else {
                        // $Notification->signal_id = $insertedId = $PredictionIdeas->id;
                        // $Notification->save();
                        // $tokens = Fcm_token::where('user_choice', '!=', 0)->get();
                        // foreach ($tokens as $tok) {
                        //     // print_r($tok->device_id);
                        //     if (AppSetting::where('device_id', $tok->device_id)->exists()) {
                        //         // echo 'Yes';
                        //         $app_setting = AppSetting::where('device_id', $tok->device_id)->where('prediction_status', 1)->get();
                        //         foreach ($app_setting as $app) {
                        //             //             // echo 'Exist';
                        //             // print_r($app->device_id);
                        //             $check_token = Fcm_token::where('device_id', $app->device_id)->pluck('fcm_token')->toArray();
                        //             // print_r($check_token);
                        //             // // //                 // $tokens = Fcm_token::where('user_choice', '!=', 1)->pluck('fcm_token')->toArray();
                        //             $res = $this->send_push('Crypto Prediction', "Crypto prediction has been added. Click to view.", $check_token, date('Y-m-d'), 'Fcskill');
                        //         }
                        //     } else {
                        //         // echo 'No';
                                //         // echo 'Not Exist';
                                $tokens = Fcm_token::where('user_choice', '!=', 0)->where('prediction_notif',1)->pluck('fcm_token')->toArray();
                                $res = $this->send_push('Crypto Prediction', "Crypto prediction has been added. Click to view.", $tokens, date('Y-m-d'), 'Fcskill');

                                // print_r($fcm);
                        //     }
                        // }
                    
                    }

                    // return response()->json(['doneMessage' => 'Signal Added!','data' => $data]);
                    return redirect()->back()->with('doneMessage', 'Prediction Ideas Added!');
                }
            }
        }
    }

    public function edit($id)
    {
        if (auth()->user()->user_role == 1) {
            $predictionideas = PredictionIdeas::find($id);

            if ($predictionideas) {
                return view("editPredictionIdeas", compact("predictionideas"));
            } else {
                return redirect('predictionideas');
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
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',3); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    return redirect('/admin/no_access');
                }
                else{
                    $predictionideas = PredictionIdeas::find($id);

                    if ($predictionideas) {
                        return view("editPredictionIdeas", compact("predictionideas"));
                    } else {
                        return redirect('predictionideas');
                    }
                }
            }
        }
    }


    public function update(Request $request, $id)
    {
        if (auth()->user()->user_role == 1) {
            date_default_timezone_set('Asia/Karachi');

            $PredictionIdeas = PredictionIdeas::find($id);

            if ($PredictionIdeas) {

                $this->validate($request, [
                    'prediction_text' => 'required',
                    'prediction_type' => 'required',
                ]);

                $PredictionIdeas->prediction_text = $request->prediction_text;
                $PredictionIdeas->updated_at = date("Y-m-d H:i:s", strtotime('now'));

                if (!empty($request->prediction_type)) {
                    $PredictionIdeas->prediction_type = 1;
                } else {
                    $PredictionIdeas->prediction_type = 0;
                }

                if (!empty($request->status)) {
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
        else{
            $user = User::find(auth()->user()->id);
            $permission = $user->User_Has_Permission;
            // dd($permission);
            if ($permission == null) {
                return redirect('/admin/no_access');
            }
            else{
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',3); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    return redirect('/admin/no_access');
                }
                else{
                    date_default_timezone_set('Asia/Karachi');

                    $PredictionIdeas = PredictionIdeas::find($id);

                    if ($PredictionIdeas) {

                        $this->validate($request, [
                            'prediction_text' => 'required',
                            'prediction_type' => 'required',
                        ]);

                        $PredictionIdeas->prediction_text = $request->prediction_text;
                        $PredictionIdeas->updated_at = date("Y-m-d H:i:s", strtotime('now'));

                        if (!empty($request->prediction_type)) {
                            $PredictionIdeas->prediction_type = 1;
                        } else {
                            $PredictionIdeas->prediction_type = 0;
                        }

                        if (!empty($request->status)) {
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
            }
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->user_role == 1) {
            $PredictionIdeas = PredictionIdeas::find($id);
            if ($PredictionIdeas) {
                $PredictionIdeas->delete();
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
                $permission = $user->User_Has_Permission->where('user_id',auth()->user()->id)->where('permission_id',3); 
                // dd($permission);
                if ($permission->isEmpty()) {
                    return redirect('/admin/no_access');
                }
                else{
                    $PredictionIdeas = PredictionIdeas::find($id);
                    if ($PredictionIdeas) {
                        $PredictionIdeas->delete();
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
            'Another Data' => 'Another Data'
        );

        $data2 = array(
            'date' => $date,
            'mobile_application_name' => $mobile_application_name,
            'type' => '1',
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
