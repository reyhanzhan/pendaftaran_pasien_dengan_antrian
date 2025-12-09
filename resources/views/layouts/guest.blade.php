<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pendaftaran Pasien') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-500 to-blue-700">
            <!-- Logo/Header -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-white mb-2">{{ config('app.name') }}</h1>
                <p class="text-blue-100">Sistem Pendaftaran Pasien dengan Antrian</p>
            </div>

            <!-- Card Form -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg rounded-lg">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-blue-100 text-sm">
                <p>&copy; {{ date('Y') }} Klinik/Rumah Sakit. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
