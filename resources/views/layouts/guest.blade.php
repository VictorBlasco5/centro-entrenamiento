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

<body class="antialiased bg-black" style="font-family: 'Jost-Regular', sans-serif;">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6">

        <!-- Logo -->
        <div class="mb-6">
            <a href="/">
                <img src="/images/logo.png" alt="Logo" class="w-48 mx-auto">
            </a>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md px-6 py-6 bg-black border border-[#d0d0d05d] rounded-lg">
            {{ $slot }}
        </div>

    </div>
</body>

</html>