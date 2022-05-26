<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // // Check email
        // $user = User::where('email', $fields['email'])->first();

        // // Check password
        // if(!$user || !Hash::check($fields['password'], $user->password)) {
        //     return response([
        //         'message' => 'Bad creds'
        //     ], 401);
        // }

        // $token = $user->createToken('myapptoken')->accessToken;

        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];

        $response = [
            'api_token' => "sdfsdfsd34sg456trtgfxdg",
            'created_at' => "2022-03-30T12:17:50.000000Z",
            'email' => "admin@demo.com",
            'email_verified_at' => "2022-03-30T12:17:50.000000Z",
            'first_name' => "Maeves",
            'id' => 2,
            'last_name' => "Casper",
            'updated_at' => "2022-05-22T16:28:49.000000Z"
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
