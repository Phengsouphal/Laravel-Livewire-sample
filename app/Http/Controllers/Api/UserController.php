<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => 'Validation Fail'], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return response()->json(['token' => $token, 'userInfo' => $user], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 403);
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel Password Grant Client')->accessToken;
            return response()->json(['token' => $token, 'userInfo' => auth()->user()], 200);
        } else {
            return response()->json(['errors' => 'Something went wrong'], 401);
        }
    }
}
