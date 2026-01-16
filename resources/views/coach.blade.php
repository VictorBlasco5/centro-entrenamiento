<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, user-scalable=yes">

        <!-- FullCalendar CDN -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>

    @vite('resources/css/app.css')
    <title>Entrenador</title>

</head>


<body>
    <header>
        @include('layouts.navigation')
    </header>

    <main>

    @include('coach.coach-sessions')
    @include('coach.coach-calendar')
    </main>
    
    <footer>
        @include('layouts.footer')
    </footer>
</body>

</html>