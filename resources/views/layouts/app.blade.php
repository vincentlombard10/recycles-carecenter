<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'CareCenter') }}</title>
        {!! ToastMagic::styles() !!}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-sidebar-navigation />
        <div id="main" class="ml-16">
            {{ $slot }}
        </div>
{{--        <div class="ml-16 mb-3 text-xs">
            <div class="mx-auto max-w-[1200px] border-t-1 border-t-violet-600 py-2">{{ app()->version() }} | Care Center {{ app_version() ?? config('app.version') }} - {{ app_version_description() }}</div>
        </div>--}}
        {!! ToastMagic::scripts() !!}
    </body>
</html>
