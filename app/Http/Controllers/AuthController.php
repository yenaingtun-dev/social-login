<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
        register user
    */
    public function register()
    {
        return view('auth.register');
    }

    /*
        login user
    */
    public function login()
    {
        return view('auth.login');
    }
}
