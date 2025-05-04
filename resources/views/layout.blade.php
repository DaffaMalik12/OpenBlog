<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Blog')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>OpenBlog</title>
</head>

<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto py-8">
        @yield('content')
    </div>
</body>

</html>
