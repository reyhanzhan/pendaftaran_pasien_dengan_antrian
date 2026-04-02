<x-dokter-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Jadwal Praktek Saya</h1>
        <a href="{{ route('dokter.jadwal.create') }}" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-xl transition">
            + Tambah Jadwal
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terisi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($jadwals as $jadwal)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_praktek)->isoFormat('dddd, D MMM Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $jadwal->kuota }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="{{ $jadwal->terisi >= $jadwal->kuota ? 'text-red-600 font-bold' : 'text-gray-800 dark:text-gray-200' }}">
                                    {{ $jadwal->terisi }}/{{ $jadwal->kuota }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $jadwal->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $jadwal->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('dokter.jadwal.edit', $jadwal) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-lg">Edit</a>
                                <form action="{{ route('dokter.jadwal.destroy', $jadwal) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs rounded-lg">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada jadwal praktek</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($jadwals->hasPages())
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                {{ $jadwals->links() }}
            </div>
        @endif
    </div>
</x-dokter-layout>
