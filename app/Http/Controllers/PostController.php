<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function create()
    {
        if (!session()->has('bearerToken')) {
            return redirect()->route('login');
        }
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session('bearerToken'))->post('http://127.0.0.1:8000/api/posts', [
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if ($response->failed()) {
            throw ValidationException::withMessages([
                'email' => $response->json('data'),
            ]);
        }
        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        if (!session()->has('bearerToken')) {
            return redirect()->route('login');
        }
        $post = Http::withToken(session('bearerToken'))->get("http://127.0.0.1:8000/api/posts/$id")->json('data');
        return view('posts.edit', compact('post'));
    }

    public function update($id, Request $request)
    {
        $response = Http::withToken(session('bearerToken'))->put("http://127.0.0.1:8000/api/posts/$id", [
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if ($response->failed()) {
            throw ValidationException::withMessages([
                'email' => $response->json('data'),
            ]);
        }
        return redirect()->route('dashboard');
    }

    public function destory($id)
    {
        Http::withToken(session('bearerToken'))->delete("http://127.0.0.1:8000/api/posts/$id");
        return redirect()->route('dashboard');
    }
}
