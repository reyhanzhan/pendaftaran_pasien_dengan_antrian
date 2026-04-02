<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.dokter.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Tambah Dokter Baru</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <form action="{{ route('admin.dokter.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kode_dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kode Dokter <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="kode_dokter" name="kode_dokter" value="{{ old('kode_dokter') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Contoh: DKT001">
                    @error('kode_dokter')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Dokter <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_dokter" name="nama_dokter" value="{{ old('nama_dokter') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="dr. Nama Lengkap, Sp.XXX">
                    @error('nama_dokter')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="spesialisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Spesialisasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="spesialisasi" name="spesialisasi" value="{{ old('spesialisasi') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Contoh: Penyakit Dalam">
                    @error('spesialisasi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rumah_sakit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Rumah Sakit
                    </label>
                    <input type="text" id="rumah_sakit" name="rumah_sakit" value="{{ old('rumah_sakit') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Nama Rumah Sakit">
                    @error('rumah_sakit')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL Foto
                    </label>
                    <input type="url" id="foto" name="foto" value="{{ old('foto') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="https://example.com/foto.jpg">
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="konsultasi_online" value="1" {{ old('konsultasi_online') ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Konsultasi Online</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.dokter.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition">
                    Simpan Dokter
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
