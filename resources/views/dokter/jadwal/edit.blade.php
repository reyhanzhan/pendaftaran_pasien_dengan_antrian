<x-dokter-layout>
    <div class="mb-6">
        <a href="{{ route('dokter.jadwal.index') }}" class="text-gray-600 hover:text-gray-800">&larr; Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Edit Jadwal Praktek</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
        <form action="{{ route('dokter.jadwal.update', $jadwal) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_praktek" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Praktek</label>
                    <input type="date" id="tanggal_praktek" name="tanggal_praktek" value="{{ $jadwal->tanggal_praktek instanceof \Carbon\Carbon ? $jadwal->tanggal_praktek->format('Y-m-d') : $jadwal->tanggal_praktek }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="kuota" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kuota Pasien</label>
                    <input type="number" id="kuota" name="kuota" value="{{ $jadwal->kuota }}" required min="1" max="100"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jam Mulai</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jam Selesai</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select id="is_active" name="is_active" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="1" {{ $jadwal->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$jadwal->is_active ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('dokter.jadwal.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl">Batal</a>
                <button type="submit" class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-xl">Update Jadwal</button>
            </div>
        </form>
    </div>
</x-dokter-layout>
