<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        {{-- fontawesoem icons --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        <style>
            table, tr, td,th{
                vertical-align: middle;
                border:1px solid gray;
                text-align: center
            }

            tr th span{
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        {{ $slot }}

        @livewireScripts
    </body>
</html>
