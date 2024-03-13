<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!(session()->has('bearerToken'))) {
            return redirect()->route('login');
        }
        $posts = Http::withToken(session('bearerToken'))->get('http://127.0.0.1:8000/api/posts')->json('data');
        return view('dashboard', compact('posts'));
    }
}
