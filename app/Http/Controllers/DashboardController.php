<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!(session()->has('bearerToken'))) {
            return redirect()->route('login');
        }
        return view('dashboard');
    }
}
