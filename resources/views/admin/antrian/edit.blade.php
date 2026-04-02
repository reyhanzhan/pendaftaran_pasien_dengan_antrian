<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.antrian.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Edit Antrian #{{ $antrian->nomor }}</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <form action="{{ route('admin.antrian.update', $antrian->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="dokter_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Dokter
                    </label>
                    <select id="dokter_id" name="dokter_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Pilih Dokter</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" {{ $antrian->dokter_id == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama_dokter }} - {{ $dokter->spesialisasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ $antrian->tanggal }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jam Mulai
                    </label>
                    <input type="time" id="jam_mulai" name="jam_mulai" value="{{ $antrian->jam_mulai }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jam Selesai
                    </label>
                    <input type="time" id="jam_selesai" name="jam_selesai" value="{{ $antrian->jam_selesai }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div class="md:col-span-2">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="menunggu" {{ $antrian->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="dipanggil" {{ $antrian->status == 'dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                        <option value="selesai" {{ $antrian->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="tidak_hadir" {{ $antrian->status == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.antrian.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition">
                    Update Antrian
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
