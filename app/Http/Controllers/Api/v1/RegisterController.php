<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    public function __construct()
    {
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            // 'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return parent::sendError($validator->getMessageBag()->toArray(), 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $accessToken =  $user->createToken('MyApp')->accessToken;
        $success['token'] = $accessToken;
        $success['name'] =  $user->name;
        return parent::sendResponse($success, 200);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            // Validation error..
            return parent::sendError($validator->getMessageBag()->toArray(), 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            return parent::sendResponse($success, 200);
        } else {
            return parent::sendError('Unauthorize Access', 400);
        }
    }
}
