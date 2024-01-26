<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/css/style.css'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
         <div class="@yield('class') min-h-screen flex flex-col sm:flex-row justify-center sm:justify-between items-center bg-gray-100">
               @yield('content')
             <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg mr-8">
                 @yield('slot')
             </div>
         </div>
    </body>
</html>
