<x-dokter-layout>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Dashboard Dokter</h1>

    @if($dokter)
    <div class="mb-6 bg-gradient-to-r from-teal-600 to-teal-800 rounded-2xl p-6 text-white">
        <h2 class="text-2xl font-bold">Selamat Datang, {{ $dokter->nama_dokter }}</h2>
        <p class="text-teal-100 mt-1">{{ $dokter->spesialisasi ?? 'Dokter Umum' }} - {{ $dokter->rumah_sakit ?? '' }}</p>
        <p class="text-teal-200 text-sm mt-2">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jadwal Aktif</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['jadwal_aktif'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Antrian Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['antrian_hari_ini'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Menunggu</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['antrian_menunggu'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Selesai</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stats['pasien_selesai'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('dokter.konsultasi.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 hover:shadow-md transition group">
            <div class="flex items-center">
                <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center mr-4 group-hover:bg-teal-600 group-hover:text-white transition">
                    <svg class="w-7 h-7 text-teal-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-white">Kelola Antrian</h3>
                    <p class="text-sm text-gray-500">Panggil dan kelola antrian pasien hari ini</p>
                </div>
            </div>
        </a>

        <a href="{{ route('dokter.jadwal.create') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 hover:shadow-md transition group">
            <div class="flex items-center">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mr-4 group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg class="w-7 h-7 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-white">Tambah Jadwal</h3>
                    <p class="text-sm text-gray-500">Buat jadwal praktek baru</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Antrian Hari Ini -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Antrian Hari Ini</h3>
            <form action="{{ route('dokter.konsultasi.callNext') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition text-sm">
                    Panggil Selanjutnya
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pasien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentAntrians as $antrian)
                        <tr class="{{ $antrian->status === 'dipanggil' ? 'bg-yellow-50 dark:bg-yellow-900/20' : '' }}">
                            <td class="px-6 py-4 text-2xl font-bold {{ $antrian->status === 'dipanggil' ? 'text-red-600' : 'text-gray-800 dark:text-white' }}">
                                {{ $antrian->nomor }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $antrian->pasien_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $antrian->pasien_nik ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $antrian->jam_mulai }} - {{ $antrian->jam_selesai }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClass = match($antrian->status) {
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'dipanggil' => 'bg-red-100 text-red-800 animate-pulse',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'tidak_hadir' => 'bg-gray-100 text-gray-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $antrian->status)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada antrian hari ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-8 text-center">
            <p class="text-yellow-800 font-medium">Profil dokter Anda belum terhubung. Hubungi administrator.</p>
        </div>
    @endif
</x-dokter-layout>
