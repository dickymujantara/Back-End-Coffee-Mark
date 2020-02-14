<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Profile;

class RegisterController extends Controller
{
    protected $status = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'username' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()],401);
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input); 
        $profile = Profile::create(['id_user' => $user->id]);

        $success['token'] =  $user->createToken('1')->accessToken; 
        $success['user'] =  $user;
        $success['user']['profile'] =  $profile;

        return response()->json(['success'=>$success], $this->status); 
    }
}
