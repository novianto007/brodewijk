<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{

    protected function response($isError, $msg, $data, $statusCode = 200)
    {
        return response()->json([
            'error' => $isError,
            'message' => $msg,
            'data' => $data
        ], $statusCode);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

    protected function customValidate(Request $request, array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($data, $rules, $messages, $customAttributes);
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }
}
