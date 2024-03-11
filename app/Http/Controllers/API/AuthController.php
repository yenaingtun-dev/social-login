<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        try {
            $response = Http::post('http://127.0.0.1:8000/api/register', [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ]);
            return response()->json($response->collect(), $response->status());
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        try {
            $response = Http::post('http://127.0.0.1:8000/api/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json($response->collect(), $response->status());
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
