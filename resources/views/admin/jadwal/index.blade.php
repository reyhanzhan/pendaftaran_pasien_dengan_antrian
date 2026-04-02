<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Jadwal Praktek</h1>
            <p class="text-gray-600 dark:text-gray-400">Daftar semua jadwal praktek dokter</p>
        </div>
        <a href="{{ route('admin.jadwal.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Jadwal
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        @if($jadwals->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Dokter</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Jam</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Kuota</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($jadwals as $jadwal)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $jadwal->tanggal_praktek->isoFormat('dddd, D MMM Y') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900 dark:text-white">{{ $jadwal->dokter->nama_dokter ?? '-' }}</span>
                                    <br><span class="text-xs text-gray-500">{{ $jadwal->dokter->spesialisasi ?? '' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm {{ $jadwal->terisi >= $jadwal->kuota ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                                        {{ $jadwal->terisi }}/{{ $jadwal->kuota }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($jadwal->is_active)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="text-yellow-600 hover:text-yellow-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $jadwals->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <p class="text-gray-500 dark:text-gray-400">Belum ada jadwal praktek.</p>
            </div>
        @endif
    </div>
</x-admin-layout>
