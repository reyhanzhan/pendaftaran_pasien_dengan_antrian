<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Dokter</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-teal-800 transform transition-transform lg:translate-x-0" id="sidebar">
            <div class="flex items-center justify-center h-16 bg-teal-900">
                <span class="text-white text-xl font-bold">Dokter Panel</span>
            </div>
            
            <nav class="mt-8">
                <a href="{{ route('dokter.dashboard') }}" class="flex items-center px-6 py-3 text-teal-100 hover:bg-teal-700 hover:text-white transition {{ request()->routeIs('dokter.dashboard') ? 'bg-teal-700 text-white border-l-4 border-teal-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('dokter.jadwal.index') }}" class="flex items-center px-6 py-3 text-teal-100 hover:bg-teal-700 hover:text-white transition {{ request()->routeIs('dokter.jadwal.*') ? 'bg-teal-700 text-white border-l-4 border-teal-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Jadwal Praktek
                </a>
                
                <a href="{{ route('dokter.konsultasi.index') }}" class="flex items-center px-6 py-3 text-teal-100 hover:bg-teal-700 hover:text-white transition {{ request()->routeIs('dokter.konsultasi.*') ? 'bg-teal-700 text-white border-l-4 border-teal-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Konsultasi / Antrian
                </a>

                <a href="{{ route('dokter.profil.index') }}" class="flex items-center px-6 py-3 text-teal-100 hover:bg-teal-700 hover:text-white transition {{ request()->routeIs('dokter.profil.*') ? 'bg-teal-700 text-white border-l-4 border-teal-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil Dokter
                </a>

                <div class="border-t border-teal-700 my-4"></div>
                
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-teal-100 hover:bg-teal-700 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="lg:pl-64">
            <div class="sticky top-0 z-40 flex items-center justify-between h-16 bg-white dark:bg-gray-800 shadow px-6">
                <button onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <div class="flex items-center ml-auto">
                    <span class="text-gray-700 dark:text-gray-300 mr-4">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Logout</button>
                    </form>
                </div>
            </div>

            <main class="p-6">
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        <strong class="font-bold">Berhasil!</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <strong class="font-bold">Error!</strong>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('info'))
                    <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg">
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
