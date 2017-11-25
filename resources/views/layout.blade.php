<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DevTools') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <script>
            window.DT = {!!
                json_encode([
                    'csrfToken' => csrf_token(),
                    'title' => config('app.name', 'DevTools'),
                    'listTimezone' => DateTimeZone::listIdentifiers()
                ]);
            !!}
        </script>

    </head>
    <body class="grey">
        <div id="app">
            @yield('content')
        </div>
    </body>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
