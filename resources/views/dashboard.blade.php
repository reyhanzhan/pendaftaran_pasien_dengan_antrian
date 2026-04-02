<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard Pasien') }}
            </h2>
            <span class="text-sm text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm">
                {{ now()->isoFormat('dddd, D MMMM Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-blue-100 mb-6 max-w-lg">Jangan lupa jaga kesehatan. Jika Anda merasa kurang sehat, segera ambil nomor antrian dan konsultasikan dengan dokter kami.</p>
                        
                        <a href="{{ route('konsultasi.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 font-bold rounded-xl shadow-md hover:bg-gray-50 transition transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Ambil Antrian Baru
                        </a>
                    </div>
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                </div>

                @php
                    $antrianAktif = \DB::table('antrians')
                        ->where('user_id', Auth::id())
                        ->whereIn('status', ['menunggu', 'dipanggil'])
                        ->where('created_at', '>=', now()->startOfDay())
                        ->orderBy('created_at', 'desc')
                        ->first();
                @endphp

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border {{ $antrianAktif ? 'border-green-200 bg-green-50 dark:bg-green-900' : 'border-gray-100' }} flex flex-col justify-center items-center text-center">
                    @if($antrianAktif)
                        <p class="text-gray-600 dark:text-gray-300 text-sm font-medium uppercase tracking-wider mb-2">Nomor Antrian Anda Hari Ini</p>
                        <div class="text-6xl font-extrabold {{ $antrianAktif->status === 'dipanggil' ? 'text-red-600' : 'text-green-600' }} mb-2">
                            {{ $antrianAktif->nomor }}
                        </div>
                        <p class="text-xs {{ $antrianAktif->status === 'dipanggil' ? 'text-red-600 bg-red-100' : 'text-green-600 bg-green-100' }} px-3 py-1 rounded-md font-bold">
                            ● {{ $antrianAktif->status === 'dipanggil' ? 'SEDANG DIPANGGIL' : 'Menunggu Panggilan' }}
                        </p>
                    @else
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider mb-2">Belum Ada Antrian</p>
                        <div class="text-5xl font-extrabold text-gray-300 mb-2">
                            -
                        </div>
                        <p class="text-xs text-gray-600 bg-gray-100 px-3 py-1 rounded-md font-bold">● Tidak Ada</p>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-2xl border border-blue-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Status Kunjungan Hari Ini
                    </h3>

                    <div class="bg-gray-50 rounded-xl p-8 text-center border-2 border-dashed border-gray-200">
                        @if($antrianAktif)
                            <div class="text-green-600 mb-3">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-gray-900 font-bold text-lg mb-2">Nomor Antrian Aktif</p>
                            <p class="text-gray-600">Anda telah terdaftar untuk antrian. Nomor antrian Anda adalah <span class="font-bold text-2xl text-blue-600">{{ $antrianAktif->nomor }}</span></p>
                            <p class="text-sm text-gray-500 mt-3">Perhatikan papan informasi untuk panggilan nomor Anda.</p>
                            <div class="mt-4">
                                <a href="{{ route('konsultasi.show') }}" class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition">
                                    Lihat Detail Antrian
                                </a>
                            </div>
                        @else
                            <div class="text-gray-400 mb-3">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-gray-600 font-medium">Anda belum mengambil antrian untuk hari ini.</p>
                            <p class="text-sm text-gray-500 mt-1">Silakan klik tombol "Ambil Antrian Baru" di atas jika ingin berobat.</p>
                        @endif
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                    <h4 class="font-bold text-gray-800 mb-4">Menu Cepat</h4>
                    <div class="space-y-3">
                        <a href="{{ route('profil.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200 group">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3 group-hover:bg-indigo-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-700">Profil Pasien</h5>
                                <p class="text-xs text-gray-500">Update data diri Anda</p>
                            </div>
                        </a>
                        <a href="{{ route('hasil-lab.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200 group">
                            <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mr-3 group-hover:bg-pink-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-700">Hasil Lab</h5>
                                <p class="text-xs text-gray-500">Lihat hasil pemeriksaan</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-bold text-gray-800">Riwayat Kunjungan</h4>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50 rounded-lg">
                                <tr>
                                    <th class="px-4 py-3 rounded-l-lg">Tanggal</th>
                                    <th class="px-4 py-3">Poli</th>
                                    <th class="px-4 py-3">Dokter</th>
                                    <th class="px-4 py-3 rounded-r-lg">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-900">10 Des 2025</td>
                                    <td class="px-4 py-3">Poli Gigi</td>
                                    <td class="px-4 py-3">drg. Siti Aminah</td>
                                    <td class="px-4 py-3">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-900">24 Nov 2025</td>
                                    <td class="px-4 py-3">Poli Umum</td>
                                    <td class="px-4 py-3">dr. Budi Santoso</td>
                                    <td class="px-4 py-3">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>