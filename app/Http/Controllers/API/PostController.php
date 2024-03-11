<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $response = Http::withToken($request->bearerToken())->get('http://127.0.0.1:8000/api/posts');
            return response()->json($response->collect(), $response->status());
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $response = Http::withToken($request->bearerToken())->post('http://127.0.0.1:8000/api/posts', [
                'title' => $request->title,
                'description' => $request->description
            ]);
            return response()->json($response->collect(), $response->status());
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        try {
            $response = Http::withToken($request->bearerToken())->get('http://127.0.0.1:8000/api/posts/' . $id);
            return response()->json($response->collect(), $response->status());
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, Request $request)
    {
        try {
            $response = Http::withToken($request->bearerToken())->put('http://127.0.0.1:8000/api/posts/' . $id, [
                'title' => $request->title,
                'description' => $request->description
            ]);
            return response()->json($response->collect(), $response->status());
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $response = Http::withToken($request->bearerToken())->delete('http://127.0.0.1:8000/api/posts/' . $id);
            return response()->json($response->collect(), $response->status());
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
