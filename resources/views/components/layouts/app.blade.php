<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        
         @vite(['resources/css/app.css', 'resources/js/app.js'])
         @livewireStyles
    </head>
    <body class="text-neutral-700 font-sans">
        <header>
            <x-navbar />
        </header>
        {{ $slot }}
         @livewireScripts
    </body>
</html>
