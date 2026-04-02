<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Antrian</h1>
            <p class="text-gray-600 dark:text-gray-400">Kelola antrian pasien hari ini</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 mb-6">
        <form action="{{ route('admin.antrian.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ request('tanggal', today()->format('Y-m-d')) }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="dipanggil" {{ request('status') == 'dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="tidak_hadir" {{ request('status') == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        @if($antrians->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Pasien</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">NIK</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Dokter</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($antrians as $antrian)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 {{ $antrian->status === 'dipanggil' ? 'bg-red-50 dark:bg-red-900' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-2xl font-bold {{ $antrian->status === 'dipanggil' ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">
                                        {{ $antrian->nomor }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $antrian->pasien_name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $antrian->pasien_nik ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $antrian->nama_dokter ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @switch($antrian->status)
                                        @case('menunggu')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                            @break
                                        @case('dipanggil')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dipanggil</span>
                                            @break
                                        @case('selesai')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                            @break
                                        @case('tidak_hadir')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Hadir</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.antrian.edit', $antrian->id) }}" class="text-yellow-600 hover:text-yellow-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.antrian.destroy', $antrian->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus antrian ini?')">
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
                {{ $antrians->appends(request()->query())->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <p class="text-gray-500 dark:text-gray-400">Tidak ada antrian.</p>
            </div>
        @endif
    </div>
</x-admin-layout>
