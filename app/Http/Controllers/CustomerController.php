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
        return $this->response(false, 'success', Auth::user());
    }
}
