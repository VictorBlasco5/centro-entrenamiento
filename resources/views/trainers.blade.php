<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, user-scalable=yes">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logonegro.png') }}?v=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logonegro.png') }}?v=1">

    @vite('resources/css/app.css')
    <title>Entrenadores</title>

</head>


<body>
    <header>
        @include('layouts.navigation')
    </header>

    <main>
        @include('trainers.cards')
    </main>

    <footer>
        @include('layouts.footer')
    </footer>
</body>

</html>