<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Tambah Jadwal Praktek</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <form action="{{ route('admin.jadwal.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="dokter_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Dokter <span class="text-red-500">*</span>
                    </label>
                    <select id="dokter_id" name="dokter_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Pilih Dokter</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama_dokter }} - {{ $dokter->spesialisasi }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_praktek" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tanggal Praktek <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal_praktek" name="tanggal_praktek" value="{{ old('tanggal_praktek') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('tanggal_praktek')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="kuota" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kuota Pasien <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="kuota" name="kuota" value="{{ old('kuota', 30) }}" min="1" max="100" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('kuota')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jam Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', '08:00') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('jam_mulai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jam Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', '12:00') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('jam_selesai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2 flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Jadwal Aktif</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.jadwal.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
