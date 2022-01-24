<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function register(Request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        return response([
            'message' => 'Register success fully'
        ], 200);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        // return $request;
        $craditional = $request->only('email', 'password');
        $validUser = Auth::once($craditional);
        if ($validUser) {
            $user = Auth::user();
            return response([
                'user' => $user,
                'token' => $user->createToken('Register')->plainTextToken,
            ], 200);

        }
        return response([
            'error' => 'login fail'
        ],400);
    }
}
