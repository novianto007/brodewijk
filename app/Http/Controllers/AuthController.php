<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'string',
            'username' => 'required|unique:customers',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'required|regex:/(08)[0-9]{8,13}/',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $input = $request->all();
            $input['password'] = app('hash')->make($input['password']);
            $user = Customer::create($input);
            return $this->response(false, 'Registration Success', $user, 201);
        } catch (\Exception $e) {
            return $this->response(true, 'Registration Failed!', null, 409);
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
        if (!$token = Auth::attempt([$fieldType => $request->identifier, 'password' => $request->password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
