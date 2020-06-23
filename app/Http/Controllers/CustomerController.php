<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    /**
     * Instantiate a new CustomerController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated Customer.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['customer' => Auth::user()], 200);
    }
}
