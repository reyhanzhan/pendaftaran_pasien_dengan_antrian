<x-dokter-layout>
    <div class="mb-6">
        <a href="{{ route('dokter.jadwal.index') }}" class="text-gray-600 hover:text-gray-800">&larr; Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Tambah Jadwal Praktek</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
        <form action="{{ route('dokter.jadwal.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_praktek" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Praktek</label>
                    <input type="date" id="tanggal_praktek" name="tanggal_praktek" value="{{ old('tanggal_praktek') }}" required min="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('tanggal_praktek') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="kuota" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kuota Pasien</label>
                    <input type="number" id="kuota" name="kuota" value="{{ old('kuota', 20) }}" required min="1" max="100"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('kuota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jam Mulai</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', '08:00') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('jam_mulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jam Selesai</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', '12:00') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('jam_selesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('dokter.jadwal.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl">Batal</a>
                <button type="submit" class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-xl">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</x-dokter-layout>
