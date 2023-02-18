<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Has_Permission;
use Hash;
use App\Models\Permission;
use Carbon\Carbon;

class RolesController extends Controller
{
    public function index()
    {
        $users = User::where('user_role', 2)->orderBy('created_at','desc')->get();
        return view('users', compact('users'));
    }


    public function add(){
        $permission = Permission::all();
        return view("addUser",compact('permission'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'signal_type' => 'required',
        ]);
        $permission_id = $request->input('permission_id');
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
            
            foreach($permission_id as $permission){
                $User_Has_Permission = new User_Has_Permission;
                $User_Has_Permission->user_id = $User->id;
                $User_Has_Permission->permission_id = $permission;
                $User_Has_Permission->save();
            }
            
        }
        
        return redirect()->back()->with('doneMessage', 'User Added!');        
    }

    public function edit($id){

        $user = User::find($id);
        $permission = Permission::all();
        $user_has_permission = $user->User_Has_Permission->pluck('permission_id')->toArray();
        // $user_has_permission = User_Has_Permission::where('user_id',$id)->pluck('permission_name')->toArray();
        if ($user) {
            return view("editUser", compact("user","user_has_permission","permission"));
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
                'permission_id' => 'required',
            ]);
            // return $User->User_Has_Permission;
            $permission_id = $request->input('permission_id');
            $User->name = $request->name;
            $User->email = $request->email;
            if(!empty($request->password)){
                $User->password = Hash::make($request->password);
            }
            $User->user_role = 2;
            $User->signal_type = $request->signal_type;
            if($User->save()){
                // $User_Has_Permission = User_Has_Permission::where('user_id',$id)->get();
                foreach($permission_id as $permission){
                // $User->User_Has_Permission->delete();
                    $User_Has_Permission = User_Has_Permission::where('user_id',$id)->delete();
                }
                foreach($permission_id as $permission){
                    $User_Has_Permission = new User_Has_Permission;
                    $User_Has_Permission->user_id = $id;
                    $User_Has_Permission->permission_id = $permission;
                    $User_Has_Permission->save();
                }
            };
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