<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    //
    public function index(){
        $news = News::orderBy('created_at','desc')->get();
        return view('news',compact('news'));
    }
    public function add(){
        return view("addNews");
    }

    public function store(Request $request){
            $this->validate($request, [
                'news_text' => 'required'
            ]);
            
            $news = new News;
            $news->news_text = $request->news_text;
            $news->save();

            return redirect()->back()->with('doneMessage', 'Successfully saved.');
    }

    public function edit($id){

        $new = News::find($id);

        if ($new) {
            return view("editNews", compact("new"));
        } else {
            return redirect('news');
        }
    }
    
    public function update(Request $request,$id){
         $new = News::find($id);

        if($new){

            $this->validate($request, [
                'news_text' => 'required',
            ]);

            $new->news_text = $request->news_text;
            $new->updated_at = date("Y-m-d H:i:s", strtotime('now'));


            $new->save();

            return redirect()->back()->with('doneMessage', 'Edit Done!');
        } else {
            return redirect('news');
        }

    }
    public function destroy($id)
    {
        $news = news::find($id);
        if ($news) {
            $news->delete();
            return redirect()->back()->with('doneMessage', 'News Deleted');
        } else {
            return redirect()->back()->with('doneMessage', 'News Not Exist!');
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