<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Customer;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required|string',
            'lastName' => 'string',
            'username' => 'required|unique:customers',
            'email' => 'required|email|unique:customers',
            'phoneNumber' => 'required|regex:/(08)[0-9]{8,13}/',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $user = new Customer;
            $user->firstName = $request->input('firstName');
            $user->lastName = $request->input('lastName');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->phoneNumber = $request->input('phoneNumber');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->save();
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

     /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);
        $fieldType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (! $token = Auth::attempt([$fieldType => $request->identifier, 'password' => $request->password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
