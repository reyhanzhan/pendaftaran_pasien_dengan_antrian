<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.dokter.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-center">
                @if($dokter->foto)
                    <img src="{{ $dokter->foto }}" alt="{{ $dokter->nama_dokter }}" class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-white shadow-lg">
                @else
                    <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center mx-auto shadow-lg">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                @endif
                <h2 class="text-xl font-bold text-white mt-4">{{ $dokter->nama_dokter }}</h2>
                <p class="text-blue-100">{{ $dokter->spesialisasi }}</p>
            </div>
            
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-xs text-gray-500 uppercase">Kode Dokter</p>
                    <p class="text-gray-900 dark:text-white font-medium">{{ $dokter->kode_dokter }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase">Rumah Sakit</p>
                    <p class="text-gray-900 dark:text-white font-medium">{{ $dokter->rumah_sakit ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase">Konsultasi Online</p>
                    @if($dokter->konsultasi_online)
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Tersedia</span>
                    @endif
                </div>
            </div>

            <div class="px-6 pb-6 flex space-x-2">
                <a href="{{ route('admin.dokter.edit', $dokter) }}" class="flex-1 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-center font-medium rounded-lg transition">
                    Edit
                </a>
                <form action="{{ route('admin.dokter.destroy', $dokter) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Jadwal Praktek -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">Jadwal Praktek</h3>
            </div>
            
            @if($dokter->jadwalPrakteks->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Jam</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Kuota</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($dokter->jadwalPrakteks->sortByDesc('tanggal_praktek')->take(10) as $jadwal)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($jadwal->tanggal_praktek)->isoFormat('dddd, D MMM Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-600 dark:text-gray-300">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-300">{{ $jadwal->terisi }}/{{ $jadwal->kuota }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($jadwal->is_active)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <p class="text-gray-500 dark:text-gray-400">Belum ada jadwal praktek.</p>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
