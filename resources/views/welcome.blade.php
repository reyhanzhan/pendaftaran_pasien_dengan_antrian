<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - Pendaftaran Pasien Online</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Custom CSS untuk garis penghubung langkah (simulasi) */
            @media (min-width: 768px) {
                .step-connector::after {
                    content: '';
                    position: absolute;
                    top: 50%;
                    right: -50%; /* Sesuaikan jarak antar kolom */
                    transform: translateY(-50%);
                    width: calc(100% - 24px); 
                    height: 2px;
                    background-color: #a5b4fc; /* Warna biru muda */
                    z-index: -1;
                }
                .grid-flow-steps > div:not(:last-child) {
                    position: relative;
                }
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <nav class="bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <div class="text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10h16V7M4 7h16M4 7h16M4 7V6a2 2 0 012-2h12a2 2 0 012 2v1M4 17v1a2 2 0 002 2h12a2 2 0 002-2v-1"></path>
                            </svg>
                        </div>
                        <span class="font-extrabold text-2xl text-gray-900 tracking-tight">{{ config('app.name') }}</span>
                    </div>
                    <div class="space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-medium hover:bg-blue-700 transition duration-300 transform hover:scale-105">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium transition duration-300">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-medium hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="bg-blue-600 text-white py-24 px-4 relative overflow-hidden">
            <svg class="absolute inset-0 h-full w-full opacity-10" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <path fill="#ffffff" fill-opacity="1" d="M0,192L80,186.7C160,181,320,171,480,186.7C640,203,800,245,960,250.7C1120,256,1280,224,1360,208L1440,192L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
            </svg>
            <div class="max-w-7xl mx-auto text-center relative z-10">
                <h1 class="text-6xl font-extrabold mb-4 tracking-tight drop-shadow-lg">Pendaftaran Pasien Digital</h1>
                <p class="text-xl text-blue-100 mb-10 drop-shadow-md">Daftar, kelola antrian, dan nikmati layanan kesehatan tanpa antri lama.</p>
                @guest
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="inline-block bg-white text-blue-600 px-10 py-3 rounded-xl font-bold hover:bg-gray-100 transition duration-300 transform hover:translate-y-[-2px] shadow-xl">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-block bg-blue-800 text-white px-10 py-3 rounded-xl font-bold hover:bg-blue-900 transition duration-300 transform hover:translate-y-[-2px] shadow-xl">Daftar Sekarang Juga</a>
                    </div>
                @endguest
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-24">
            <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-16">Keunggulan Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                
                <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="bg-blue-50 text-blue-600 w-14 h-14 rounded-full flex items-center justify-center mb-4 text-3xl mx-auto">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 text-center">Pendaftaran Mudah</h3>
                    <p class="text-gray-600 text-center">Registrasi awal dapat dilakukan sepenuhnya secara online, menghemat waktu dan tenaga Anda di klinik.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="bg-blue-50 text-blue-600 w-14 h-14 rounded-full flex items-center justify-center mb-4 text-3xl mx-auto">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 text-center">Pantauan Antrian Real-time</h3>
                    <p class="text-gray-600 text-center">Cek posisi antrian Anda dari mana saja, meminimalisir waktu tunggu yang membosankan di ruang tunggu.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="bg-blue-50 text-blue-600 w-14 h-14 rounded-full flex items-center justify-center mb-4 text-3xl mx-auto">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 text-center">Jadwal yang Fleksibel</h3>
                    <p class="text-gray-600 text-center">Lihat ketersediaan dokter secara *up-to-date* dan buat janji sesuai kenyamanan Anda.</p>
                </div>
            </div>
        </div>

        <hr class="max-w-7xl mx-auto border-gray-200">
        
        <div class="bg-gray-100 py-20 px-4">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-16">Alur Pendaftaran 4 Langkah Mudah</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 grid-flow-steps">
                    
                    <div class="text-center bg-white p-6 rounded-lg shadow-lg step-connector">
                        <div class="bg-blue-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 font-extrabold text-xl ring-4 ring-blue-300">1</div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Buat Akun Pasien</h3>
                        <p class="text-gray-600 text-sm">Registrasi diri Anda secara cepat menggunakan email dan data pribadi yang valid.</p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-lg shadow-lg step-connector">
                        <div class="bg-blue-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 font-extrabold text-xl ring-4 ring-blue-300">2</div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Pilih Janji Temu</h3>
                        <p class="text-gray-600 text-sm">Tentukan dokter spesialis dan jadwal praktik yang tersedia sesuai keinginan Anda.</p>
                    </div>
                    
                    <div class="text-center bg-white p-6 rounded-lg shadow-lg step-connector">
                        <div class="bg-blue-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 font-extrabold text-xl ring-4 ring-blue-300">3</div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Konfirmasi & Antrian</h3>
                        <p class="text-gray-600 text-sm">Dapatkan kode konfirmasi dan nomor antrian unik Anda secara instan.</p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-lg shadow-lg">
                        <div class="bg-blue-600 text-white w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 font-extrabold text-xl ring-4 ring-blue-300">4</div>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Datang & Konsultasi</h3>
                        <p class="text-gray-600 text-sm">Kunjungi klinik Anda tepat waktu untuk menerima layanan medis.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-blue-700 text-white py-20 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-extrabold mb-4">Mulai Pengalaman Kesehatan yang Lebih Baik</h2>
                <p class="text-xl text-blue-200 mb-10">Daftar sekarang dan bergabunglah dengan komunitas pasien yang cerdas dan efisien.</p>
                @guest
                    <a href="{{ route('register') }}" class="inline-block bg-white text-blue-700 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-xl">Daftar Akun Sekarang</a>
                @endguest
            </div>
        </div>

        <footer class="bg-gray-900 text-white py-12 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 border-b border-gray-700 pb-8">
                    <div class="md:col-span-1">
                        <h3 class="font-extrabold text-xl mb-4 text-blue-400">{{ config('app.name') }}</h3>
                        <p class="text-gray-400 text-sm">Sistem pendaftaran pasien online yang mudah, cepat, dan terpercaya. Prioritas kami adalah kenyamanan Anda.</p>
                    </div>
                    
                    <div class="md:col-span-1">
                        <h3 class="font-bold text-lg mb-4">Layanan</h3>
                        <ul class="space-y-3 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-blue-400 transition">Pendaftaran Online</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Lihat Antrian</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Jadwal Dokter</a></li>
                        </ul>
                    </div>
                    
                    <div class="md:col-span-1">
                        <h3 class="font-bold text-lg mb-4">Navigasi</h3>
                        <ul class="space-y-3 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-blue-400 transition">Beranda</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">FAQ</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    
                    <div class="md:col-span-1">
                        <h3 class="font-bold text-lg mb-4">Hubungi Kami</h3>
                        <ul class="space-y-3 text-gray-400 text-sm">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>info@klinik.com</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.128a11.042 11.042 0 005.516 5.516l1.128-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-11a2 2 0 01-2-2v-10z"></path></svg>
                                <span>(021) 1234-5678</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Jl. Kesehatan No. 123, Kota Sehat</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pt-6 text-center text-gray-500 text-sm">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </footer>
    </body>
</html>