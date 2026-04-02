<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('hasil-lab.index') }}" class="mr-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Hasil Laboratorium') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Header Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-purple-800 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-purple-200 text-sm">Nomor Lab</p>
                            <h3 class="text-2xl font-bold text-white">{{ $hasilLab->nomor_lab }}</h3>
                        </div>
                        <div class="text-right">
                            {!! $hasilLab->status_badge !!}
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Tanggal Pemeriksaan</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $hasilLab->tanggal_pemeriksaan->isoFormat('dddd, D MMMM Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Jenis Pemeriksaan</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $hasilLab->jenis_pemeriksaan }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Dokter Pengirim</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $hasilLab->dokter_pengirim ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil Pemeriksaan -->
            @if($hasilLab->hasil && count($hasilLab->hasil) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Hasil Pemeriksaan
                        </h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Parameter
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Hasil
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Satuan
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nilai Normal
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Keterangan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($hasilLab->hasil as $item)
                                    @php
                                        $status = $item['status'] ?? 'normal';
                                        $statusClass = match($status) {
                                            'tinggi' => 'text-red-600 font-bold',
                                            'rendah' => 'text-blue-600 font-bold',
                                            default => 'text-gray-900 dark:text-white',
                                        };
                                    @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $item['parameter'] ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm {{ $statusClass }}">{{ $item['hasil'] ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $item['satuan'] ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $item['nilai_normal'] ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($status === 'tinggi')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Tinggi</span>
                                            @elseif($status === 'rendah')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Rendah</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Normal</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Catatan -->
            @if($hasilLab->catatan)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-yellow-50 dark:bg-yellow-900 px-6 py-4 border-b border-yellow-200 dark:border-yellow-700">
                        <h3 class="text-lg font-bold text-yellow-800 dark:text-yellow-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Catatan Dokter
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $hasilLab->catatan }}</p>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex justify-between items-center">
                <a href="{{ route('hasil-lab.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak Hasil
                </button>
            </div>

        </div>
    </div>
</x-app-layout>
