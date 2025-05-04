<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get("https://api-berita-indonesia.vercel.app/cnn/terbaru/");

        $blog = $response->successful() ? $response->json() : [];
        $terbaru = $blog['data']['posts'] ?? [];

        // Convert array to Laravel Collection
        $collection = collect($terbaru);

        // Pagination
        $perPage = 9;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('index', [
            'blog' => $blog,
            'terbaru' => $paginated,
        ]);
    }
}
