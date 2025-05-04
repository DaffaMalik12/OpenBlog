<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get("https://api-berita-indonesia.vercel.app/cnn/terbaru/");

        $blog = $response->successful() ? $response->json() : [];

        $terbaru = $blog['data']['posts'] ?? [];

        return view('index', compact('blog', 'terbaru'));
    }
}
