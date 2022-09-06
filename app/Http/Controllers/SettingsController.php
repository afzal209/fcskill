<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_option;
use App\Models\User;
use Hash;

class SettingsController extends Controller
{

    public function terms_and_conditions()
    {
        $data = General_option::where('meta_key', '=', 'terms_and_conditions')->first();
        return view('terms_and_conditions', compact('data'));
    }

    public function terms_update(Request $request)
    {
        $General_option = General_option::where('meta_key', 'terms_and_conditions')->first();

        if($General_option){

            $this->validate($request, [
                'terms_and_conditions' => 'required'
            ]);

            $General_option->meta_value = $request->terms_and_conditions;
            $General_option->save();

            return redirect()->back()->with('doneMessage', 'Successfully saved.');
        } else {
            return redirect('admin/terms_and_conditions');
        }
    }

    public function brokers_ranking()
    {
        $forex_ranking = General_option::where('meta_key', '=', 'forex_brokers_ranking')->first();
        $crypto_ranking = General_option::where('meta_key', '=', 'crypto_brokers_ranking')->first();
        return view('brokers_ranking', compact('forex_ranking', 'crypto_ranking'));
    }

    public function brokers_ranking_update(Request $request)
    {

        if($request->ranking_type == 'forex') {

            $General_option = General_option::where('meta_key', 'forex_brokers_ranking')->first();

            if($General_option){

                $this->validate($request, [
                    'forex_brokers_ranking' => 'required'
                ]);

                $General_option->meta_value = $request->forex_brokers_ranking;
                $General_option->save();

                return redirect()->back()->with('doneMessage', 'Successfully saved.');
            } else {
                return redirect('admin/brokers-ranking');
            }

        } else {


            $General_option = General_option::where('meta_key', 'crypto_brokers_ranking')->first();

            if($General_option){

                $this->validate($request, [
                    'crypto_brokers_ranking' => 'required'
                ]);

                $General_option->meta_value = $request->crypto_brokers_ranking;
                $General_option->save();

                return redirect()->back()->with('doneMessage', 'Successfully saved.');
            } else {
                return redirect('admin/brokers-ranking');
            }


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

    public function settings(Request $request)
    {
        $support_phone = General_option::where('meta_key', 'phone_number')->first();
        $support_email = General_option::where('meta_key', 'support_email')->first();
        return view('settings', compact('support_phone', 'support_email'));
    }

    public function change_password(Request $request)
    {
         # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }


    public function update_support_details(Request $request)
    {
        $support_phone = General_option::where('meta_key', '=', 'phone_number')->first();
        $support_email = General_option::where('meta_key', '=', 'support_email')->first();

        if($support_phone){

            $this->validate($request, [
                'phone_number' => 'required',
                'email' => 'required'
            ]);

            $support_phone->meta_value = $request->phone_number;
            $support_email->meta_value = $request->email;

            $support_phone->save();
            $support_email->save();

            return redirect()->back()->with('doneMessage', 'Successfully saved.');
        } else {
            return redirect('admin/settings');
        }
    }

}