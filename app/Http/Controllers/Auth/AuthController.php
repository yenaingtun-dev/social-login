<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function show_register()
    {
        if (!session()->has('bearerToken')) {
            return view('auth.register');
        }
        return redirect()->route('dashboard');
    }

    public function register(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ]);
        if ($response->failed()) {
            throw ValidationException::withMessages([
                'email' => $response->json('data'),
            ]);
        }
        session(['bearerToken' => $response->json('accessToken')]);
        return redirect()->route('dashboard');
    }

    public function show_login()
    {
        if (!session()->has('bearerToken')) {
            return view('auth.login');
        }
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if ($response->failed()) {
            throw ValidationException::withMessages([
                'email' => $response->json('data'),
            ]);
        }
        session(['bearerToken' => $response->json('accessToken')]);
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        if (session()->has('bearerToken')) {
            $request->session()->forget('bearerToken');
        }
        return redirect()->route('login');
    }
}
