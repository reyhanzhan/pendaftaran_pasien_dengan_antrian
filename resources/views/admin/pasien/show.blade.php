<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.pasien.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-center">
                <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center mx-auto shadow-lg">
                    <span class="text-2xl font-bold text-blue-600">{{ strtoupper(substr($pasien->name, 0, 2)) }}</span>
                </div>
                <h2 class="text-xl font-bold text-white mt-4">{{ $pasien->name }}</h2>
                <p class="text-blue-100">{{ $pasien->email }}</p>
            </div>
            
            <div class="p-6 space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">NIK</span><span class="text-gray-900 dark:text-white font-medium">{{ $pasien->nik ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">No. Telp</span><span class="text-gray-900 dark:text-white font-medium">{{ $pasien->no_telp ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Jenis Kelamin</span><span class="text-gray-900 dark:text-white font-medium">{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : ($pasien->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Tanggal Lahir</span><span class="text-gray-900 dark:text-white font-medium">{{ $pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->isoFormat('D MMM Y') : '-' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Golongan Darah</span><span class="text-gray-900 dark:text-white font-medium">{{ $pasien->golongan_darah ?? '-' }}</span></div>
            </div>

            <div class="px-6 pb-6">
                <a href="{{ route('admin.pasien.edit', $pasien) }}" class="block w-full px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-center font-medium rounded-lg transition">
                    Edit Data
                </a>
            </div>
        </div>

        <!-- Info & History -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Health Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Informasi Kesehatan</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Alamat</p>
                        <p class="text-gray-900 dark:text-white">{{ $pasien->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Riwayat Alergi</p>
                        <p class="text-gray-900 dark:text-white">{{ $pasien->alergi ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Riwayat Penyakit</p>
                        <p class="text-gray-900 dark:text-white">{{ $pasien->riwayat_penyakit ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Antrian -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Riwayat Kunjungan Terakhir</h3>
                </div>
                @if($antrians->count() > 0)
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($antrians as $antrian)
                            <div class="px-6 py-4 flex justify-between items-center">
                                <div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Antrian #{{ $antrian->nomor }}</span>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($antrian->created_at)->isoFormat('D MMM Y, HH:mm') }}</p>
                                </div>
                                @switch($antrian->status)
                                    @case('selesai')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                        @break
                                    @case('tidak_hadir')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Hadir</span>
                                        @break
                                    @default
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($antrian->status) }}</span>
                                @endswitch
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center text-gray-500">Belum ada riwayat kunjungan.</div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
