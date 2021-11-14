<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!-- Google maps -->
        <script  
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvkng0zoDdWrYqpiK-TWksc5roz13nEQY&libraries=places&language=fr-FR">
        </script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>

    {{-- <!-- Google maps -->
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvkng0zoDdWrYqpiK-TWksc5roz13nEQY&libraries=places&language=fr-FR">
    </script> --}}
    
</html>
