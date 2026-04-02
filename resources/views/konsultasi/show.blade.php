<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nomor Antrian Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 dark:bg-green-900 dark:text-green-100">
                            <strong>✓ {{ session('success') }}</strong>
                        </div>
                    @endif

                    @if ($antrian)
                        <div class="text-center mb-12">
                            <h1 class="text-3xl font-bold mb-2">Nomor Antrian Anda</h1>
                            <p class="text-gray-600 dark:text-gray-400">Simpan dan tunggu panggilan Anda</p>
                        </div>

                        <!-- Nomor Antrian - Large Display -->
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-12 text-white mb-8 shadow-lg text-center">
                            <p class="text-sm opacity-90 mb-2">NOMOR ANTRIAN</p>
                            <p class="text-7xl font-extrabold tracking-wider">{{ $antrian->nomor }}</p>
                            @if($dokter)
                                <p class="text-sm opacity-90 mt-4">{{ $dokter->nama_dokter }}</p>
                            @endif
                            @if($antrian->jam_mulai && $antrian->jam_selesai)
                                <p class="text-lg font-semibold mt-2">Slot: {{ $antrian->jam_mulai }} - {{ $antrian->jam_selesai }}</p>
                            @endif
                        </div>

                        <!-- Status Info -->
                        <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-6 mb-8 border-l-4 border-blue-500">
                            <h3 class="font-semibold text-lg mb-4 text-blue-900 dark:text-blue-100">Status Antrian</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700 dark:text-gray-300">Status</span>
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold 
                                        {{ $antrian->status === 'dipanggil' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($antrian->status) }}
                                    </span>
                                </div>
                                @if($dokter)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700 dark:text-gray-300">Dokter</span>
                                    <span class="font-semibold">{{ $dokter->nama_dokter }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700 dark:text-gray-300">Spesialis</span>
                                    <span class="font-semibold">{{ $dokter->spesialisasi ?? 'Dokter Umum' }}</span>
                                </div>
                                @endif
                                @if($antrian->tanggal)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700 dark:text-gray-300">Tanggal</span>
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($antrian->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                                </div>
                                @endif
                                @if($antrian->jam_mulai)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700 dark:text-gray-300">Slot Waktu</span>
                                    <span class="font-semibold text-blue-600">{{ $antrian->jam_mulai }} - {{ $antrian->jam_selesai }}</span>
                                </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700 dark:text-gray-300">Waktu Pengambilan</span>
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($antrian->created_at)->format('d-m-Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="bg-yellow-50 dark:bg-yellow-900 rounded-lg p-6 mb-8 border-l-4 border-yellow-500">
                            <h3 class="font-semibold text-lg mb-4 text-yellow-900 dark:text-yellow-100">⚠️ Petunjuk Penting</h3>
                            <ul class="space-y-2 text-sm text-yellow-800 dark:text-yellow-100">
                                <li>✓ Hadir 15 menit sebelum slot waktu Anda ({{ $antrian->jam_mulai ?? '-' }})</li>
                                <li>✓ Perhatikan papan informasi untuk panggilan nomor Anda</li>
                                <li>✓ Siapkan kartu identitas (KTP/SIM) dan dokumen yang diperlukan</li>
                                <li>✓ Hadir di tempat konsultasi saat nomor Anda dipanggil</li>
                                <li>✓ Jika tidak hadir, nomor akan dinyatakan tidak hadir</li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 justify-center">
                            <a href="{{ route('konsultasi.index') }}"
                                class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg transition duration-200">
                                Kembali
                            </a>
                            <a href="{{ route('dashboard') }}"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition duration-200">
                                Dashboard
                            </a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">❌</div>
                            <h2 class="text-2xl font-bold mb-4">Data Antrian Tidak Ditemukan</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                Silakan kembali dan ambil nomor antrian terlebih dahulu.
                            </p>
                            <a href="{{ route('konsultasi.index') }}"
                                class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition duration-200">
                                Kembali ke Menu Konsultasi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
