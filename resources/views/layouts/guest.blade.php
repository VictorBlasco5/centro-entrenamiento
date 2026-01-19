<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-black flex flex-col min-h-screen" style="font-family: 'Jost-Regular', sans-serif;">

    @include('layouts.navigation')

    <main class="flex-grow flex flex-col items-center pt-4 p-4 gap-6">

        <div>
            <a href="/">
                <img src="/images/logo.png" alt="Logo" class="w-40 mx-auto">
            </a>
        </div>

        <div class="w-full sm:max-w-md px-6 py-6 bg-black border border-[#d0d0d05d] rounded-lg">
            {{ $slot }}
        </div>

    </main>

    @include('layouts.footer')

</body>

</html>