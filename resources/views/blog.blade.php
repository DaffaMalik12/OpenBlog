@extends('layout')

@section('content')
    <div class="max-w-6xl mx-auto p-10 bg-white shadow-lg rounded-lg">

        {{-- Breadcrumb --}}
        <nav class="text-sm mb-6 text-gray-600">
            <a href="{{ route('blog.index') }}" class="text-blue-600 hover:underline">Home</a>
            / <span>{{ $post['title'] }}</span>
        </nav>

        {{-- Judul --}}
        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $post['title'] }}</h1>

        {{-- Tanggal --}}
        <p class="text-gray-500 text-sm mb-6">{{ \Carbon\Carbon::parse($post['pubDate'])->translatedFormat('l, d F Y H:i') }}
        </p>

        {{-- Gambar --}}
        @if (!empty($post['thumbnail']))
            <img src="{{ $post['thumbnail'] }}" alt="Thumbnail"
                class="rounded-lg mb-6 w-full h-auto max-h-[500px] object-cover">
        @endif

        {{-- Deskripsi lengkap (langsung dari API) --}}
        <div class="text-gray-800 text-lg leading-relaxed mb-10">
            {!! $blogs['description'] !!}
        </div>

        {{-- Tombol Share --}}
        <div class="mt-8">
            <p class="text-base text-gray-600 mb-2 font-semibold">Share this post:</p>
            <div class="flex gap-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank"
                    class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                    Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($post['title']) }}"
                    target="_blank" class="px-5 py-2 bg-sky-500 text-white rounded hover:bg-sky-600 transition text-sm">
                    Twitter/X
                </a>
                <button onclick="navigator.clipboard.writeText('{{ Request::fullUrl() }}'); alert('Copied to clipboard!')"
                    class="px-5 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition text-sm">
                    Copy Link
                </button>
            </div>
        </div>
    </div>
@endsection
