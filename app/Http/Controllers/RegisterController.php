<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Signal_User;
use Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
     public function register(Request $request)
    {
        // return $request;
        $validation = Validator::make(
            $request->all(),
            [   
                'name' => 'required|string',
                'email' => 'required|string|unique:signal__users,email',
                'password' => 'required|string|confirmed|min:8',
            ]
        );

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()->all()]);
        }

        $user  = new Signal_User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->signal_type = $request->signal_type;
        $user->password = bcrypt($request->password);
       
        $user->save();

        return response()->json(['message' => 'User Registration Successfully'],200);
    }

    public function login(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $user = Signal_User::where('email',$request['email'])->first();
        if($user == null ){
            return response([
                'message' => 'Account Not created'
            ]);
        }
        else if (!$user || !Hash::check($request['password'], $user->password)) {
                return response([
                    'message' => 'Password does not matched'
                ]);
            
        }
        else{
            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'redirect_url' => 'signal-type',
                'token' => $token,
            ];
    
            return response()->json($response,201);
        }
         
        
        
    }
    
}