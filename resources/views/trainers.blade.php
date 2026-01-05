<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, user-scalable=yes">

    @vite('resources/css/app.css')
    <title>Entrenadores</title>

</head>


<body>
    <header>
        @include('layouts.navigation')
    </header>

    <main>
        @include('trainers.cards')
        @include('layouts.footer')
    </main>
</body>

</html>
