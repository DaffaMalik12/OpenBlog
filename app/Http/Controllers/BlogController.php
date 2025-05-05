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

    public function blog($encodedLink)
    {
        $link = urlSafeDecode($encodedLink); // gunakan helper

        if (!$link) {
            abort(404, 'Invalid blog link');
        }

        $response = Http::get("https://api-berita-indonesia.vercel.app/cnn/terbaru/");

        if (!$response->successful()) {
            abort(500, 'Failed to fetch blog data');
        }

        $blogs = $response->json()['data']['posts'] ?? [];

        $post = collect($blogs)->firstWhere('link', $link);

        if (!$post) {
            abort(404, 'Blog not found');
        }

        return view('blog', ['post' => $post]);
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('q');

    //     $response = Http::get("https://api-berita-indonesia.vercel.app/cnn/terbaru");

    //     if (!$response->successful()) {
    //         abort(500, 'Failed to fetch blog data');
    //     }

    //     $posts = $response->json()['data']['posts'] ?? [];

    //     $filtered = collect($posts)->filter(function ($post) use ($query) {
    //         return str_contains(strtolower($post['title']), strtolower($query));
    //     });

    //     return view('index', [
    //         'blog' => ['data' => ['posts' => $filtered->values()]],
    //         'terbaru' => new LengthAwarePaginator(
    //             $filtered->values(),
    //             $filtered->count(),
    //             9,
    //             LengthAwarePaginator::resolveCurrentPage(),
    //             ['path' => $request->url(), 'query' => $request->query()]
    //         ),
    //         'searchQuery' => $query
    //     ]);
    // }
}
