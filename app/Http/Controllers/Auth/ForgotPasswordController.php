<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
// use Mail;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {

        return view('auth.password.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        // Mail::send('auth.password.verify', ['token' => $token], function($message) use ($request) {
        //     $message->from('admin@example.com');
        //     $message->to($request->email);
        //     $message->subject('Reset Password Notification');
        // });

        $to = $request->email;
        $subject = "Reset Password Notification";

        $message = "<b>Hi,</b>";
        $message .= "<p>Please reset your password using blow link</p>";
        $message .= "<a href='".route('reset_password', $token)."'>Click Here</a>";
        $message .= "<p>Thanks</p>";

        $header = "From: Fcskill <noreply@fcskill.com> \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $retval = mail ($to,$subject,$message,$header);

        if( $retval == true ) {
            return back()->with('message', 'We have e-mailed your password reset link!');
        }else {
            return back()->with('message', 'Message could not be sent...');
        }
    }
}