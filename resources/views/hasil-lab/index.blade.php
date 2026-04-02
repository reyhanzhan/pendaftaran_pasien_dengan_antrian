<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Laboratorium') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Card -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-2xl p-6 text-white shadow-lg mb-6">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 rounded-full p-4 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-1">Hasil Pemeriksaan Laboratorium</h3>
                        <p class="text-purple-100">Lihat semua hasil pemeriksaan lab Anda di sini</p>
                    </div>
                </div>
            </div>

            <!-- Results List -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
                @if($hasilLabs->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        No. Lab
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Jenis Pemeriksaan
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Dokter Pengirim
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($hasilLabs as $hasil)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $hasil->nomor_lab }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $hasil->tanggal_pemeriksaan->isoFormat('D MMM Y') }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $hasil->jenis_pemeriksaan }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $hasil->dokter_pengirim ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {!! $hasil->status_badge !!}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($hasil->status === 'selesai' || $hasil->status === 'diambil')
                                                <a href="{{ route('hasil-lab.show', $hasil) }}" class="inline-flex items-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold rounded-lg transition">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    Lihat Hasil
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs italic">Menunggu hasil</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $hasilLabs->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="mx-auto w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-2">Belum Ada Hasil Lab</h3>
                        <p class="text-gray-500 dark:text-gray-400">Anda belum memiliki hasil pemeriksaan laboratorium.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
