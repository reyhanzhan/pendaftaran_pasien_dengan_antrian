<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - Rumah Sakit Terpercaya</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-white">
        <!-- Top Bar -->
        <div class="bg-blue-900 text-white text-sm py-2 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <span class="hover:text-blue-200 cursor-pointer">Pasien & Pengunjung</span>
                    <span class="hover:text-blue-200 cursor-pointer">Perusahaan</span>
                    <span class="hover:text-blue-200 cursor-pointer">Info Kesehatan</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-2 hover:text-blue-200 cursor-pointer">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        WhatsApp
                    </span>
                    <span>Hubungi Kami 1-500-911</span>
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-1 hover:text-blue-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-1 hover:text-blue-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Masuk/Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-8">
                        <a href="/" class="flex items-center gap-2">
                            <div class="text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <span class="font-bold text-xl text-blue-900">RS Sehat Sentosa</span>
                        </a>
                        <div class="hidden lg:flex items-center gap-6">
                            <a href="{{ route('cari-dokter') }}" class="text-gray-600 hover:text-blue-700 font-medium">Cari Dokter</a>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer flex items-center gap-1">
                                Layanan Kesehatan
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer">Pusat Layanan Unggulan</span>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer">Spesialis</span>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer flex items-center gap-1">
                                Pusat Informasi
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-800 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-700 font-medium hidden md:block">Masuk</a>
                            <a href="{{ route('register') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-800 transition">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-blue-50 via-white to-blue-50 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-30">
                <div class="absolute top-20 right-20 w-72 h-72 bg-blue-200 rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-20 left-20 w-96 h-96 bg-blue-100 rounded-full filter blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 py-20 relative z-10">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-6">
                            #1 Rumah Sakit Pilihan Keluarga
                        </span>
                        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight mb-6">
                            Kesehatan Anda, <span class="text-blue-600">Prioritas</span> Kami
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Layanan kesehatan terpadu dengan dokter spesialis berpengalaman. 
                            Daftar online, hemat waktu, dan nikmati pelayanan prima.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('cari-dokter') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-700 text-white font-semibold rounded-xl hover:bg-blue-800 transition shadow-lg shadow-blue-700/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Cari Dokter
                            </a>
                            @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-blue-700 font-semibold rounded-xl border-2 border-blue-700 hover:bg-blue-50 transition">
                                Daftar Sekarang
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                            @endguest
                        </div>
                        
                        <!-- Stats -->
                        <div class="flex gap-12 mt-12 pt-8 border-t border-gray-200">
                            <div>
                                <p class="text-4xl font-bold text-blue-700">41+</p>
                                <p class="text-gray-500 text-sm">Cabang RS</p>
                            </div>
                            <div>
                                <p class="text-4xl font-bold text-blue-700">500+</p>
                                <p class="text-gray-500 text-sm">Dokter Spesialis</p>
                            </div>
                            <div>
                                <p class="text-4xl font-bold text-blue-700">1M+</p>
                                <p class="text-gray-500 text-sm">Pasien Terlayani</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Image / Illustration -->
                    <div class="hidden lg:flex justify-center items-end">
                        <div class="relative">
                            <!-- Main Doctor Illustration -->
                            <div class="w-80 h-96 bg-gradient-to-b from-blue-100 to-blue-200 rounded-t-full relative overflow-hidden">
                                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-64 h-80">
                                    <svg class="w-full h-full text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            </div>
                            <!-- Stethoscope Icon -->
                            <div class="absolute -top-4 -right-4 w-20 h-20 bg-white rounded-2xl shadow-xl flex items-center justify-center">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <!-- Medical Cross -->
                            <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-red-500 rounded-2xl shadow-xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Card 1 -->
                    <a href="{{ route('cari-dokter') }}" class="group p-6 bg-gradient-to-br from-blue-50 to-white rounded-2xl border border-blue-100 hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                        <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Cari Dokter</h3>
                        <p class="text-gray-600 text-sm">Temukan dokter spesialis sesuai kebutuhan Anda</p>
                    </a>

                    <!-- Card 2 -->
                    <a href="{{ route('konsultasi.index') }}" class="group p-6 bg-gradient-to-br from-green-50 to-white rounded-2xl border border-green-100 hover:shadow-xl hover:border-green-200 transition-all duration-300">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Ambil Antrian</h3>
                        <p class="text-gray-600 text-sm">Daftar online dan dapatkan nomor antrian</p>
                    </a>

                    <!-- Card 3 -->
                    <div class="group p-6 bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 hover:shadow-xl hover:border-purple-200 transition-all duration-300 cursor-pointer">
                        <div class="w-14 h-14 bg-purple-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Telekonsultasi</h3>
                        <p class="text-gray-600 text-sm">Konsultasi online dengan dokter dari rumah</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="group p-6 bg-gradient-to-br from-orange-50 to-white rounded-2xl border border-orange-100 hover:shadow-xl hover:border-orange-200 transition-all duration-300 cursor-pointer">
                        <div class="w-14 h-14 bg-orange-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Rekam Medis</h3>
                        <p class="text-gray-600 text-sm">Akses riwayat kesehatan Anda kapan saja</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gray-50 py-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">Kami berkomitmen memberikan layanan kesehatan terbaik dengan teknologi modern</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pendaftaran Cepat</h3>
                        <p class="text-gray-600">Daftar online dalam hitungan menit. Tidak perlu antri panjang di rumah sakit.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center">
                        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Dokter Berpengalaman</h3>
                        <p class="text-gray-600">Tim medis profesional dengan pengalaman bertahun-tahun di bidangnya.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Akses Dimana Saja</h3>
                        <p class="text-gray-600">Kelola janji temu dan pantau antrian dari smartphone Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Cara Mendaftar</h2>
                    <p class="text-gray-600 text-lg">4 langkah mudah untuk mendapatkan layanan kesehatan</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center relative">
                        <div class="w-16 h-16 bg-blue-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">1</div>
                        <h3 class="font-bold text-gray-900 mb-2">Buat Akun</h3>
                        <p class="text-gray-600 text-sm">Daftar dengan email dan lengkapi data NIK Anda</p>
                        <!-- Connector Line -->
                        <div class="hidden md:block absolute top-8 left-1/2 w-full h-0.5 bg-blue-200"></div>
                    </div>

                    <div class="text-center relative">
                        <div class="w-16 h-16 bg-blue-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">2</div>
                        <h3 class="font-bold text-gray-900 mb-2">Pilih Dokter</h3>
                        <p class="text-gray-600 text-sm">Cari dokter spesialis sesuai kebutuhan</p>
                        <div class="hidden md:block absolute top-8 left-1/2 w-full h-0.5 bg-blue-200"></div>
                    </div>

                    <div class="text-center relative">
                        <div class="w-16 h-16 bg-blue-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold relative z-10">3</div>
                        <h3 class="font-bold text-gray-900 mb-2">Pilih Jadwal</h3>
                        <p class="text-gray-600 text-sm">Tentukan tanggal dan slot waktu kunjungan</p>
                        <div class="hidden md:block absolute top-8 left-1/2 w-full h-0.5 bg-blue-200"></div>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">4</div>
                        <h3 class="font-bold text-gray-900 mb-2">Datang & Berobat</h3>
                        <p class="text-gray-600 text-sm">Kunjungi RS sesuai jadwal dan tunjukkan nomor antrian</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-700 to-blue-900 py-20">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Siap Untuk Memulai?</h2>
                <p class="text-xl text-blue-100 mb-10">Daftar sekarang dan rasakan kemudahan layanan kesehatan digital</p>
                @guest
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register') }}" class="inline-block bg-white text-blue-700 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition shadow-xl">
                            Daftar Akun Gratis
                        </a>
                        <a href="{{ route('cari-dokter') }}" class="inline-block bg-transparent text-white px-10 py-4 rounded-xl font-bold text-lg border-2 border-white hover:bg-white/10 transition">
                            Lihat Dokter Kami
                        </a>
                    </div>
                @else
                    <a href="{{ route('cari-dokter') }}" class="inline-block bg-white text-blue-700 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition shadow-xl">
                        Cari Dokter Sekarang
                    </a>
                @endguest
            </div>
        </div>

        <!-- App Download Section -->
        <div class="bg-blue-900 py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/3 flex justify-center">
                        <div class="relative w-56 h-[380px]">
                            <div class="absolute inset-0 bg-gray-900 rounded-[3rem] shadow-2xl"></div>
                            <div class="absolute inset-2 bg-white rounded-[2.5rem] overflow-hidden flex flex-col items-center justify-center p-4">
                                <div class="w-16 h-16 bg-blue-600 rounded-2xl mb-3 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg">RS Sehat Sentosa</h4>
                                <p class="text-xs text-gray-500">Mobile App</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:w-2/3 text-center lg:text-left">
                        <p class="text-blue-300 text-sm font-semibold mb-2 uppercase tracking-wider">Download Aplikasi</p>
                        <h3 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                            Solusi kesehatan terintegrasi,<br class="hidden lg:block"> dalam genggaman
                        </h3>
                        <ul class="text-blue-100 space-y-3 mb-8 text-lg">
                            <li class="flex items-center gap-3 justify-center lg:justify-start">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Cek janji temu dan ketersediaan dokter
                            </li>
                            <li class="flex items-center gap-3 justify-center lg:justify-start">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Telekonsultasi dengan dokter
                            </li>
                            <li class="flex items-center gap-3 justify-center lg:justify-start">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Akses rekam medis
                            </li>
                        </ul>
                        <div class="flex gap-4 justify-center lg:justify-start">
                            <a href="#" class="inline-flex items-center px-5 py-3 bg-black text-white rounded-xl hover:bg-gray-900 transition shadow-lg">
                                <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400">Download on the</p>
                                    <p class="text-sm font-semibold">App Store</p>
                                </div>
                            </a>
                            <a href="#" class="inline-flex items-center px-5 py-3 bg-black text-white rounded-xl hover:bg-gray-900 transition shadow-lg">
                                <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor"><path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/></svg>
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400">Get it on</p>
                                    <p class="text-sm font-semibold">Google Play</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-12">
                    <div class="col-span-2 md:col-span-1">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="font-bold text-xl">RS Sehat Sentosa</span>
                        </div>
                        <p class="text-gray-400 text-sm">Jaringan rumah sakit swasta terbesar dengan fasilitas lengkap dan tenaga medis profesional.</p>
                    </div>
                    
                    <div>
                        <h5 class="font-bold mb-4 text-white">Tentang Kami</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Overview</a></li>
                            <li><a href="#" class="hover:text-white transition">History</a></li>
                            <li><a href="#" class="hover:text-white transition">Pencapaian</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h5 class="font-bold mb-4 text-white">Untuk Pasien</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="{{ route('cari-dokter') }}" class="hover:text-white transition">Cari Dokter</a></li>
                            <li><a href="#" class="hover:text-white transition">Telekonsultasi</a></li>
                            <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h5 class="font-bold mb-4 text-white">Untuk Profesional</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Pusat Pelatihan</a></li>
                            <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h5 class="font-bold mb-4 text-white">Terhubung</h5>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 0 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                    <p>&copy; {{ date('Y') }} RS Sehat Sentosa. All rights reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition">Syarat dan Ketentuan</a>
                        <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
