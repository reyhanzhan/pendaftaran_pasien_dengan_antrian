<x-dokter-layout>
    <div class="mb-6">
        <a href="{{ route('dokter.konsultasi.index') }}" class="text-gray-600 hover:text-gray-800">&larr; Kembali ke Antrian</a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Detail Pasien - Antrian #{{ $antrian->nomor }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Antrian -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Info Antrian</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nomor</span>
                    <span class="text-3xl font-bold text-teal-600">{{ $antrian->nomor }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tanggal</span>
                    <span class="font-medium text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($antrian->tanggal)->isoFormat('D MMM Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Jam</span>
                    <span class="font-medium text-gray-800 dark:text-white">{{ $antrian->jam_mulai }} - {{ $antrian->jam_selesai }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Status</span>
                    @php
                        $statusClass = match($antrian->status) {
                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                            'dipanggil' => 'bg-red-100 text-red-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'tidak_hadir' => 'bg-gray-100 text-gray-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                    @endphp
                    <span class="px-3 py-1 text-sm font-medium rounded-full {{ $statusClass }}">
                        {{ ucfirst(str_replace('_', ' ', $antrian->status)) }}
                    </span>
                </div>
            </div>

            <div class="mt-6 space-y-2">
                @if($antrian->status === 'menunggu')
                    <form action="{{ route('dokter.konsultasi.updateStatus', $antrian->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="dipanggil">
                        <button class="w-full px-4 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-xl">Panggil Pasien</button>
                    </form>
                @endif
                @if($antrian->status === 'dipanggil')
                    <form action="{{ route('dokter.konsultasi.updateStatus', $antrian->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="selesai">
                        <button class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl">Selesai Konsultasi</button>
                    </form>
                @endif
                @if(in_array($antrian->status, ['menunggu', 'dipanggil']))
                    <form action="{{ route('dokter.konsultasi.updateStatus', $antrian->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="tidak_hadir">
                        <button class="w-full px-4 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-xl">Tandai Tidak Hadir</button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Info Pasien -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Informasi Pasien</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase">Nama</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $antrian->pasien_name }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase">NIK</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $antrian->pasien_nik ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase">Email</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $antrian->pasien_email ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase">Telepon</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $antrian->pasien_telp ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase">Jenis Kelamin</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $antrian->jenis_kelamin === 'L' ? 'Laki-laki' : ($antrian->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase">Tanggal Lahir</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $antrian->tanggal_lahir ? \Carbon\Carbon::parse($antrian->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase">Golongan Darah</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $antrian->golongan_darah ?? '-' }}</p>
                </div>
            </div>

            @if($antrian->alergi || $antrian->riwayat_penyakit)
                <div class="mt-6 space-y-4">
                    @if($antrian->alergi)
                        <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 p-4 rounded-lg">
                            <h4 class="font-bold text-red-800 dark:text-red-200 text-sm mb-1">Alergi</h4>
                            <p class="text-red-700 dark:text-red-300">{{ $antrian->alergi }}</p>
                        </div>
                    @endif
                    @if($antrian->riwayat_penyakit)
                        <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 p-4 rounded-lg">
                            <h4 class="font-bold text-yellow-800 dark:text-yellow-200 text-sm mb-1">Riwayat Penyakit</h4>
                            <p class="text-yellow-700 dark:text-yellow-300">{{ $antrian->riwayat_penyakit }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-dokter-layout>
