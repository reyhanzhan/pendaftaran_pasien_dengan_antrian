<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.hasil-lab.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Edit Hasil Lab - {{ $hasilLab->nomor_lab }}</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <form action="{{ route('admin.hasil-lab.update', $hasilLab) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pasien</label>
                    <select id="user_id" name="user_id" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach($pasiens as $pasien)
                            <option value="{{ $pasien->id }}" {{ $hasilLab->user_id == $pasien->id ? 'selected' : '' }}>{{ $pasien->name }} - {{ $pasien->nik ?? $pasien->email }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal_pemeriksaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Pemeriksaan</label>
                    <input type="date" id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" value="{{ $hasilLab->tanggal_pemeriksaan->format('Y-m-d') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="jenis_pemeriksaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Pemeriksaan</label>
                    <input type="text" id="jenis_pemeriksaan" name="jenis_pemeriksaan" value="{{ $hasilLab->jenis_pemeriksaan }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="dokter_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dokter Pengirim</label>
                    <input type="text" id="dokter_pengirim" name="dokter_pengirim" value="{{ $hasilLab->dokter_pengirim }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select id="status" name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="proses" {{ $hasilLab->status == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="selesai" {{ $hasilLab->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="diambil" {{ $hasilLab->status == 'diambil' ? 'selected' : '' }}>Sudah Diambil</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan</label>
                    <textarea id="catatan" name="catatan" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $hasilLab->catatan }}</textarea>
                </div>
            </div>

            <!-- Hasil Pemeriksaan -->
            <div class="mt-8">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Hasil Pemeriksaan</h3>
                <div id="hasil-container" class="space-y-4">
                    @if($hasilLab->hasil)
                        @foreach($hasilLab->hasil as $item)
                            <div class="hasil-row grid grid-cols-12 gap-2 items-end">
                                <div class="col-span-3"><input type="text" name="hasil_parameter[]" value="{{ $item['parameter'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
                                <div class="col-span-2"><input type="text" name="hasil_nilai[]" value="{{ $item['hasil'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
                                <div class="col-span-2"><input type="text" name="hasil_satuan[]" value="{{ $item['satuan'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
                                <div class="col-span-2"><input type="text" name="hasil_normal[]" value="{{ $item['nilai_normal'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
                                <div class="col-span-2">
                                    <select name="hasil_status[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="normal" {{ ($item['status'] ?? '') == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="tinggi" {{ ($item['status'] ?? '') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                        <option value="rendah" {{ ($item['status'] ?? '') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                    </select>
                                </div>
                                <div class="col-span-1">
                                    <button type="button" onclick="this.closest('.hasil-row').remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" onclick="addHasilRow()" class="mt-4 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">+ Tambah Baris</button>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.hasil-lab.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition">Update Hasil Lab</button>
            </div>
        </form>
    </div>

    <script>
    function addHasilRow() {
        const container = document.getElementById('hasil-container');
        const row = document.createElement('div');
        row.className = 'hasil-row grid grid-cols-12 gap-2 items-end';
        row.innerHTML = `
            <div class="col-span-3"><input type="text" name="hasil_parameter[]" placeholder="Parameter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
            <div class="col-span-2"><input type="text" name="hasil_nilai[]" placeholder="Hasil" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
            <div class="col-span-2"><input type="text" name="hasil_satuan[]" placeholder="Satuan" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
            <div class="col-span-2"><input type="text" name="hasil_normal[]" placeholder="Normal" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"></div>
            <div class="col-span-2">
                <select name="hasil_status[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="normal">Normal</option>
                    <option value="tinggi">Tinggi</option>
                    <option value="rendah">Rendah</option>
                </select>
            </div>
            <div class="col-span-1">
                <button type="button" onclick="this.closest('.hasil-row').remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        `;
        container.appendChild(row);
    }
    </script>
</x-admin-layout>
