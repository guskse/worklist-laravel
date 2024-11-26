<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Workopia | Find and List jobs')</title>
</head>
<body class="bg-gray-100">

    @include('partials.navbar')

    <main class="container mx-auto p-4 mt-4">
        @yield('content')
    </main>
</body>
</html>
