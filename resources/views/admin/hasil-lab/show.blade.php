<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.hasil-lab.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $hasilLab->nomor_lab }}</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $hasilLab->jenis_pemeriksaan }}</p>
                </div>
                <div>{!! $hasilLab->status_badge !!}</div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nama Pasien</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $hasilLab->user->name }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Pemeriksaan</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $hasilLab->tanggal_pemeriksaan->format('d F Y') }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Dokter Pengirim</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $hasilLab->dokter_pengirim ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ ucfirst($hasilLab->status) }}</p>
                </div>
            </div>

            @if($hasilLab->catatan)
            <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 p-4 rounded-xl mb-8">
                <h4 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-2">Catatan</h4>
                <p class="text-yellow-700 dark:text-yellow-300">{{ $hasilLab->catatan }}</p>
            </div>
            @endif

            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Hasil Pemeriksaan</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Parameter</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Hasil</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nilai Normal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($hasilLab->hasil ?? [] as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $item['parameter'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $item['hasil'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $item['satuan'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $item['nilai_normal'] ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $status = $item['status'] ?? 'normal';
                                        $statusClass = match($status) {
                                            'tinggi' => 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300',
                                            'rendah' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300',
                                            default => 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300'
                                        };
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada hasil pemeriksaan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-6 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-4">
            <a href="{{ route('admin.hasil-lab.edit', $hasilLab) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition">Edit</a>
            <form action="{{ route('admin.hasil-lab.destroy', $hasilLab) }}" method="POST" onsubmit="return confirm('Hapus hasil lab ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition">Hapus</button>
            </form>
        </div>
    </div>
</x-admin-layout>
