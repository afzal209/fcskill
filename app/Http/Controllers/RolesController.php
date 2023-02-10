<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Has_Permission;
use Hash;
use Carbon\Carbon;

class RolesController extends Controller
{
    public function index()
    {
        $users = User::where('user_role', 2)->orderBy('created_at','desc')->get();
        return view('users', compact('users'));
    }


    public function add(){
        return view("addUser");
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'signal_type' => 'required',
        ]);
        // $permission_name = $request->input('permission_name');
        $request->password = Hash::make($request->password);

        $User = new User;
        
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = $request->password;
        $User->user_role = 2;
        $User->email_verified_at = Carbon::now();
        $User->signal_type = $request->signal_type;
        $User->save();
        if($User->save()){
            
            foreach($permission_name as $permission){
                $User_Has_Permission = new User_Has_Permission;
                $User_Has_Permission->user_id = $User->id;
                $User_Has_Permission->permission_name = $permission;
                $User_Has_Permission->save();
            }
            
        }
        
        return redirect()->back()->with('doneMessage', 'User Added!');        
    }

    public function edit($id){

        $user = User::find($id);
        $permission = $user->User_Has_Permission;
        if ($user) {
            return view("editUser", compact("user","permission"));
        } else {
            return redirect('users');
        }
    }


    public function update(Request $request, $id){

        $User = User::find($id);

        if($User){

            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'same:confirm-password',
            ]);

            $User->name = $request->name;
            $User->email = $request->email;
            if(!empty($request->password)){
                $User->password = Hash::make($request->password);
            }
            $User->user_role = 2;
            $User->signal_type = $request->signal_type;
            $User->save();
            return redirect()->back()->with('doneMessage', 'Edit Done!');

        } else {
            return redirect('users');
        }

    }

    public function destroy($id)
    {
        $User = User::find($id);
        if ($User) {
            $User->delete();
            return redirect()->back()->with('doneMessage', 'User Deleted');
        } else {
            return redirect()->back()->with('doneMessage', 'User Not Exist!');
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