<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Profile;
use Validator;

class LoginController extends Controller
{
    protected $status = 200;

    public function login(Request $request)
    {
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){ 
            $user = Auth::user();
            $success['token'] =  $user->createToken('1')->accessToken;
            $success['token_type'] = 'bearer';
            $success['user'] = $user;
            $success['user']['profile'] = Profile::select()->where('id_user',Auth::user()->id)->first();

            return response()->json(['success' => $success], $this->status);

        } else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

}
