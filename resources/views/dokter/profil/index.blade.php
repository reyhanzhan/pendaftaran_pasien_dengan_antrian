<x-dokter-layout>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Profil Dokter</h1>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
        <form action="{{ route('dokter.profil.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                    <input type="text" id="nama_dokter" name="nama_dokter" value="{{ $dokter->nama_dokter }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="spesialisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Spesialisasi</label>
                    <input type="text" id="spesialisasi" name="spesialisasi" value="{{ $dokter->spesialisasi }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="rumah_sakit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rumah Sakit</label>
                    <input type="text" id="rumah_sakit" name="rumah_sakit" value="{{ $dokter->rumah_sakit }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="kode_dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kode Dokter</label>
                    <input type="text" value="{{ $dokter->kode_dokter }}" disabled
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500 dark:bg-gray-600 dark:border-gray-500">
                    <p class="text-xs text-gray-500 mt-1">Kode dokter tidak dapat diubah</p>
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="konsultasi_online" value="1" {{ $dokter->konsultasi_online ? 'checked' : '' }}
                            class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Tersedia untuk konsultasi online</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-xl">Update Profil</button>
            </div>
        </form>
    </div>
</x-dokter-layout>
