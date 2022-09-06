<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Market_education;

class MarketEductionsController extends Controller
{

    public function index()
    {
        $data = Market_education::where('id', '=', 1)->first();
        return view('market_education', compact('data'));
    }

    public function update(Request $request)
    {
        $id = 1;
        $Market_education = Market_education::find($id);

        if($Market_education){

            if($request->analysis_type == 'technical') {

                $this->validate($request, [
                    'technical_analysis' => 'required'
                ]);

                $Market_education->technical_analysis = $request->technical_analysis;

            } else {

                $this->validate($request, [
                    'fundamental_analysis' => 'required',
                ]);

                $Market_education->fundamental_analysis = $request->fundamental_analysis;

            }

            $Market_education->save();

            return redirect()->back()->with('doneMessage', 'Successfully saved.');
        } else {
            return redirect('admin/market_education');
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

}
