<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\User_Has_Permission;
class NewsController extends Controller
{
    //
    public function index(){
        if (auth()->user()->user_role == 1) {
            $news = News::orderBy('created_at','desc')->get();
        }
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',5);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $news = News::orderBy('created_at','desc')->get();
                    // return view('news',compact('news'));
                }
            
        }
        return view('news',compact('news'));

    }
    public function add(){

        if (auth()->user()->user_role == 1) {
            return view("addNews");
        }
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',5);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    return view("addNews");
                }
            }
        
    }

    public function store(Request $request){
        if (auth()->user()->user_role == 1) {
            $this->validate($request, [
                'news_text' => 'required'
            ]);
            
            $news = new News;
            $news->news_text = $request->news_text;
            $news->save();

            return redirect()->back()->with('doneMessage', 'Successfully saved.');
        }
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',5);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $this->validate($request, [
                        'news_text' => 'required'
                    ]);
                    
                    $news = new News;
                    $news->news_text = $request->news_text;
                    $news->save();
        
                    return redirect()->back()->with('doneMessage', 'Successfully saved.');
                }
            }
            
        
    }

    public function edit($id){

        if (auth()->user()->user_role == 1) {
            $new = News::find($id);

            if ($new) {
                return view("editNews", compact("new"));
            } else {
                return redirect('news');
            }
        }
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',5);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $new = News::find($id);
                    if ($new) {
                        return view("editNews", compact("new"));
                    } else {
                        return redirect('news');
                    }
                }
            
        }
    }
    
    public function update(Request $request,$id){
        if (auth()->user()->user_role == 1) {
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
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',5);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
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
            
        }

    }
    public function destroy($id)
    {
        if (auth()->user()->user_role == 1) {
            $news = news::find($id);
            if ($news) {
                $news->delete();
                return redirect()->back()->with('doneMessage', 'News Deleted');
            } else {
                return redirect()->back()->with('doneMessage', 'News Not Exist!');
            }
        }
        else{
            
                // echo 'TEst';
                $permission = User_Has_Permission::where('user_id',auth()->user()->id)->where('permission_id',5);
                if ($permission->isEmpty()) {
                    // dd('yes');
                    return redirect('/admin/no_access');
                }
                else{
                    $news = news::find($id);
                    if ($news) {
                        $news->delete();
                        return redirect()->back()->with('doneMessage', 'News Deleted');
                    } else {
                        return redirect()->back()->with('doneMessage', 'News Not Exist!');
                    }
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

            $request->file('upload')->move(public_path('assets/uploads/images'), $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/uploads/images/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;

        }
    }
}