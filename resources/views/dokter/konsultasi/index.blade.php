<x-dokter-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Konsultasi / Antrian</h1>
        <form action="{{ route('dokter.konsultasi.callNext') }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition text-sm">
                Panggil Pasien Selanjutnya
            </button>
        </form>
    </div>

    <!-- Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 mb-6">
        <form action="{{ route('dokter.konsultasi.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Semua</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="dipanggil" {{ request('status') == 'dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="tidak_hadir" {{ request('status') == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-medium">Filter</button>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Antrian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pasien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($antrians as $antrian)
                        <tr class="{{ $antrian->status === 'dipanggil' ? 'bg-yellow-50 dark:bg-yellow-900/20' : '' }}">
                            <td class="px-6 py-4">
                                <span class="text-2xl font-bold {{ $antrian->status === 'dipanggil' ? 'text-red-600' : 'text-gray-800 dark:text-white' }}">
                                    {{ $antrian->nomor }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('dokter.konsultasi.show', $antrian->id) }}" class="text-sm font-medium text-blue-600 hover:underline">
                                    {{ $antrian->pasien_name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $antrian->pasien_nik ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $antrian->pasien_telp ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $antrian->jam_mulai }} - {{ $antrian->jam_selesai }}</td>
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
                            <td class="px-6 py-4">
                                <div class="flex space-x-1">
                                    @if($antrian->status === 'menunggu')
                                        <form action="{{ route('dokter.konsultasi.updateStatus', $antrian->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="dipanggil">
                                            <button class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs rounded">Panggil</button>
                                        </form>
                                    @endif
                                    @if($antrian->status === 'dipanggil')
                                        <form action="{{ route('dokter.konsultasi.updateStatus', $antrian->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="selesai">
                                            <button class="px-2 py-1 bg-green-600 hover:bg-green-700 text-white text-xs rounded">Selesai</button>
                                        </form>
                                    @endif
                                    @if(in_array($antrian->status, ['menunggu', 'dipanggil']))
                                        <form action="{{ route('dokter.konsultasi.updateStatus', $antrian->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="tidak_hadir">
                                            <button class="px-2 py-1 bg-gray-500 hover:bg-gray-600 text-white text-xs rounded">Tidak Hadir</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada antrian</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($antrians->hasPages())
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                {{ $antrians->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-dokter-layout>
