@extends('layout')

@section('title', 'Homepage')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Blog</h1>

        {{-- Search Bar --}}
        <div class="flex items-center mb-6">
            <input type="text" placeholder="Search for article"
                class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-r-md hover:bg-blue-700">
                Search
            </button>
        </div>

        {{-- Pagination Summary --}}
        <p class="text-sm text-gray-500 mb-4">Showing {{ count($blog) }} results</p>

        {{-- Blog Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($terbaru as $item)
                <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition duration-200 mb-5">
                    <div class="flex justify-between items-center mb-3">
                        <!-- Tanggal Publikasi -->
                        <span class="text-xs text-gray-400">
                            @if (!empty($item['pubDate']))
                                {{ \Carbon\Carbon::parse($item['pubDate'])->diffForHumans() }}
                            @else
                                <p>Invalid date format or missing date</p>
                            @endif
                        </span>
                    </div>

                    <!-- Judul Artikel -->
                    <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                        {{ $item['title'] }}
                    </h2>

                    <!-- Deskripsi Artikel -->
                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                        {{ $item['description'] }}
                    </p>

                    <!-- Thumbnail dan Link ke Artikel -->
                    <div class="flex justify-between items-center mt-auto">
                        <div class="flex items-center space-x-2">
                            <!-- Thumbnail Gambar Artikel -->
                            <img src="{{ $item['thumbnail'] }}" alt="Thumbnail" class="w-16 h-16 rounded-lg object-cover">
                        </div>
                        <!-- Link untuk Baca Selengkapnya -->
                        <a href="{{ $item['link'] }}" target="_blank"
                            class="text-sm text-blue-600 font-semibold hover:underline">
                            Read more →
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="flex justify-center mt-8 space-x-1">
            @for ($i = 1; $i <= 6; $i++)
                <a href="#" class="px-3 py-1 border border-gray-300 text-sm text-gray-700 hover:bg-gray-200 rounded">
                    {{ $i }}
                </a>
            @endfor
        </div>
    </div>
@endsection
