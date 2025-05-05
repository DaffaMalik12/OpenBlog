@extends('layout')

@section('title', 'Homepage')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-3">Baca berita terbaru di OpenBlog!</h1>
        <p class="mb-6 text-lg/8 text-gray-600">OpenBlog merupakan web portal berita terbaru seputar politik, ekonomi,
            internasional, olahraga, teknologi, hiburan, gaya hidup.
        </p>

        {{-- Search Bar --}}
        <div class="flex items-center mb-6" {{-- action=" route('blog.search') " method="GET" --}}>
            <input type="text" placeholder="Search for article" {{-- name="s" --}}
                class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                {{-- value=" request('s') " --}}>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-r-md hover:bg-blue-700">
                Search
            </button>
        </div>

        {{-- Pagination Summary --}}
        <p class="text-sm text-gray-500 mb-4">Showing {{ count($blog) + 6 }} results</p>

        {{-- Blog Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($terbaru as $item)
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 max-w-md mx-auto">
                    <!-- Thumbnail -->
                    <img src="{{ $item['thumbnail'] }}" alt="Article Image" class="w-full h-48 object-cover">

                    <!-- Content -->
                    <div class="p-5">
                        <!-- PubDate & Category -->
                        <div class="flex items-center text-sm text-gray-500 space-x-2 mb-2">
                            <span>
                                @if (!empty($item['pubDate']))
                                    {{ \Carbon\Carbon::parse($item['pubDate'])->format('M d, Y') }}
                                @endif
                            </span>
                        </div>

                        <!-- Title -->
                        <h2 class="text-lg font-semibold text-gray-900 mb-2 hover:underline line-clamp-2">
                            {{ $item['title'] }}
                        </h2>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-3">
                            {{ $item['description'] }}
                        </p>

                        <!-- Link untuk Baca Selengkapnya -->
                        <a href="{{ $item['link'] }}" target="_blank"
                            class="text-sm text-blue-600 font-semibold hover:underline">
                            Read more →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $terbaru->links() }}
        </div>
    </div>
@endsection
