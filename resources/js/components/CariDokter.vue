<template>
    <div class="min-h-screen bg-white">
        <!-- Top Bar -->
        <div class="bg-blue-900 text-white text-sm py-2">
            <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <span class="hover:text-blue-200 cursor-pointer">Pasien & Pengunjung</span>
                    <span class="hover:text-blue-200 cursor-pointer">Perusahaan</span>
                    <span class="hover:text-blue-200 cursor-pointer">Info Kesehatan</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        WhatsApp
                    </span>
                    <span>Hubungi Kami 1-500-911</span>
                    <a href="/login" class="flex items-center gap-1 hover:text-blue-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Masuk/Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-8">
                        <a href="/" class="flex items-center gap-2">
                            <div class="text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <span class="font-bold text-xl text-blue-900">RS Sehat Sentosa</span>
                        </a>
                        <div class="hidden lg:flex items-center gap-6">
                            <a href="/cari-dokter" class="text-blue-700 font-semibold border-b-2 border-blue-700 pb-1">Cari Dokter</a>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer flex items-center gap-1">
                                Layanan Kesehatan
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer">Pusat Layanan Unggulan</span>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer">Spesialis/Sub-spesialis</span>
                            <span class="text-gray-600 hover:text-blue-700 cursor-pointer flex items-center gap-1">
                                Pusat Informasi
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600 text-sm">Cari di : </span>
                        <button class="p-2 hover:bg-gray-100 rounded-full">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Banner -->
        <div class="bg-gradient-to-r from-blue-50 to-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <!-- Breadcrumb -->
                <nav class="text-sm mb-4">
                    <ol class="flex items-center space-x-2 text-gray-500">
                        <li><a href="/" class="hover:text-blue-600 transition">Beranda</a></li>
                        <li><span class="mx-1">›</span></li>
                        <li class="text-gray-900 font-medium">Cari Dokter</li>
                    </ol>
                </nav>
                
                <div class="flex items-center justify-between">
                    <h1 class="text-4xl font-bold text-gray-900">Cari Dokter</h1>
                    
                    <!-- Doctor Images -->
                    <div class="hidden lg:flex items-end gap-2">
                        <div class="w-40 h-48 bg-gradient-to-b from-blue-100 to-blue-200 rounded-t-full overflow-hidden">
                            <div class="w-full h-full bg-blue-200 flex items-end justify-center">
                                <svg class="w-32 h-40 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="w-32 h-40 bg-gradient-to-b from-blue-100 to-blue-200 rounded-t-full overflow-hidden">
                            <div class="w-full h-full bg-blue-200 flex items-end justify-center">
                                <svg class="w-24 h-32 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 py-6">
                <div class="flex items-center gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input 
                            v-model="searchQuery"
                            type="text" 
                            placeholder="Ketik nama dokter atau gunakan filter"
                            class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
                        />
                    </div>
                    <button 
                        @click="showFilter = !showFilter"
                        class="flex items-center gap-2 px-6 py-3 border border-gray-200 rounded-lg hover:bg-gray-50 text-gray-700 font-medium"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </button>
                </div>
                
                <!-- Selected Filter Badge -->
                <div v-if="selectedSpesialis" class="mt-4 flex items-center gap-2">
                    <span class="text-sm text-gray-500">Filter aktif:</span>
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                        {{ selectedSpesialis.nama }}
                        <button @click="selectedSpesialis = null" class="ml-1 hover:text-blue-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 py-8">
            <!-- Results Header -->
            <h2 class="text-xl font-bold text-gray-900 mb-6">Semua Dokter</h2>

            <!-- Loading Spinner -->
            <div v-if="isLoading" class="flex justify-center py-12">
                <svg class="animate-spin h-12 w-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            <!-- Doctor Grid -->
            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <dokter-card 
                    v-for="dokter in paginatedDokters" 
                    :key="dokter.id" 
                    :dokter="dokter"
                    @pesan-janji="openPendaftaranModal"
                    @konsultasi-online="handleKonsultasiOnline"
                />
            </div>

            <!-- Empty State -->
            <div v-if="!isLoading && filteredDokters.length === 0" class="text-center py-12">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Dokter tidak ditemukan</h3>
                <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter Anda</p>
            </div>

            <!-- Pagination -->
            <div v-if="totalPages > 1" class="flex justify-center items-center gap-1 mt-10">
                <button 
                    @click="currentPage = Math.max(1, currentPage - 1)"
                    :disabled="currentPage === 1"
                    class="px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed text-gray-600"
                >
                    ←
                </button>
                
                <button 
                    v-for="page in visiblePages" 
                    :key="page"
                    @click="currentPage = page"
                    :class="[
                        'w-10 h-10 rounded border font-medium transition',
                        currentPage === page 
                            ? 'bg-blue-900 text-white border-blue-900' 
                            : 'bg-white border-gray-300 hover:bg-gray-50 text-gray-700'
                    ]"
                >
                    {{ page }}
                </button>
                
                <span v-if="totalPages > 5" class="px-2 text-gray-500">...</span>
                
                <button 
                    v-if="totalPages > 5 && currentPage < totalPages - 2"
                    @click="currentPage = totalPages"
                    class="w-10 h-10 rounded border border-gray-300 bg-white hover:bg-gray-50 font-medium text-gray-700"
                >
                    {{ totalPages }}
                </button>
                
                <button 
                    @click="currentPage = Math.min(totalPages, currentPage + 1)"
                    :disabled="currentPage === totalPages"
                    class="px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed text-gray-600"
                >
                    →
                </button>
            </div>
        </div>

        <!-- Spesialis Filter Section (Always Visible) -->
        <div class="bg-gray-50 border-t border-gray-100">
            <spesialis-filter 
                :spesialis-list="spesialisList"
                @select="filterBySpesialis"
            />
        </div>

        <!-- App Download Banner -->
        <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/3 flex justify-center">
                        <div class="relative">
                            <!-- Phone mockup -->
                            <div class="relative w-56 h-[400px]">
                                <div class="absolute inset-0 bg-gray-900 rounded-[3rem] shadow-2xl"></div>
                                <div class="absolute inset-2 bg-white rounded-[2.5rem] overflow-hidden">
                                    <div class="h-full flex flex-col items-center justify-center p-4">
                                        <div class="w-20 h-20 bg-blue-600 rounded-2xl mb-4 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="font-bold text-gray-900 text-lg mb-1">RS Sehat Sentosa</h4>
                                        <p class="text-xs text-gray-500">Mobile App</p>
                                        <div class="mt-4 space-y-2 text-xs text-gray-600">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                <span>Booking Online</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                <span>Rekam Medis</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hand holding phone -->
                                <div class="absolute -bottom-8 -left-8 w-32 h-40 opacity-80">
                                    <svg class="w-full h-full text-blue-200" fill="currentColor" viewBox="0 0 100 120">
                                        <ellipse cx="50" cy="100" rx="40" ry="20" fill="currentColor" opacity="0.3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:w-2/3 text-center lg:text-left">
                        <p class="text-blue-300 text-sm font-semibold mb-2 tracking-wider uppercase">Download Aplikasi</p>
                        <h3 class="text-3xl lg:text-4xl font-bold text-white mb-6 leading-tight">
                            Solusi kesehatan terintegrasi,<br class="hidden lg:block">dalam genggaman
                        </h3>
                        <ul class="text-blue-100 space-y-3 mb-8 text-lg">
                            <li class="flex items-center gap-3 justify-center lg:justify-start">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Cek janji temu dan ketersediaan dokter
                            </li>
                            <li class="flex items-center gap-3 justify-center lg:justify-start">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Telekonsultasi dengan dokter RS Sehat Sentosa
                            </li>
                            <li class="flex items-center gap-3 justify-center lg:justify-start">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Akses rekam medis
                            </li>
                        </ul>
                        <div class="flex gap-4 justify-center lg:justify-start">
                            <a href="#" class="inline-flex items-center px-5 py-3 bg-black text-white rounded-xl hover:bg-gray-900 transition shadow-lg">
                                <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                </svg>
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400 leading-tight">Download on the</p>
                                    <p class="text-sm font-semibold">App Store</p>
                                </div>
                            </a>
                            <a href="#" class="inline-flex items-center px-5 py-3 bg-black text-white rounded-xl hover:bg-gray-900 transition shadow-lg">
                                <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                                </svg>
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400 leading-tight">Get it on</p>
                                    <p class="text-sm font-semibold">Google Play</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Afiliasi Section -->
        <div class="bg-white py-12 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4">
                <h3 class="text-xl font-bold text-gray-900 mb-8">Afiliasi Kami</h3>
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-8">
                    <div class="w-32 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 font-bold">PARTNER 1</div>
                    <div class="w-32 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 font-bold">PARTNER 2</div>
                    <div class="w-32 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 font-bold">PARTNER 3</div>
                    <div class="w-32 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 font-bold">PARTNER 4</div>
                </div>
                <p class="text-sm text-gray-600 mt-6 max-w-4xl">
                    RS Sehat Sentosa merupakan jaringan rumah sakit swasta terbesar yang menyediakan fasilitas layanan kesehatan terlengkap. 
                    Dengan lebih dari 41 cabang rumah sakit dan 25 klinik, RS Sehat Sentosa menjangkau seluruh keluarga dengan fasilitas lengkap 
                    dan tenaga medis profesional yang siap memberikan pelayanan medis berkualitas dan berstandar internasional.
                </p>
                <button class="text-blue-600 hover:text-blue-700 text-sm font-medium mt-2">Lihat Lebih Banyak</button>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                    <div>
                        <h5 class="font-bold mb-4">Tentang Kami</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Overview</a></li>
                            <li><a href="#" class="hover:text-white transition">History</a></li>
                            <li><a href="#" class="hover:text-white transition">Pencapaian</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-bold mb-4">Untuk Pasien</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Pusat Unggulan</a></li>
                            <li><a href="#" class="hover:text-white transition">Telekonsultasi</a></li>
                            <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-bold mb-4">Untuk Perusahaan</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Laporan Keuangan</a></li>
                            <li><a href="#" class="hover:text-white transition">Laporan Tahunan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-bold mb-4">Untuk Profesional</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Pusat Pelatihan</a></li>
                            <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-bold mb-4">Ayo Terhubung dengan Kami</h5>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 0 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                    <p>&copy; {{ new Date().getFullYear() }} RS Sehat Sentosa. All rights reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition">Syarat dan Ketentuan</a>
                        <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Pendaftaran Modal -->
        <pendaftaran-form
            :show="showPendaftaranModal"
            :dokter="selectedDokter"
            :jadwals="selectedDokterJadwals"
            @close="closePendaftaranModal"
            @success="handlePendaftaranSuccess"
            @error="handlePendaftaranError"
        />

        <!-- Toast Notification -->
        <div 
            v-if="toast.show" 
            :class="[
                'fixed bottom-4 right-4 px-6 py-4 rounded-xl shadow-xl z-50 transition-all transform',
                toast.type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
            ]"
        >
            <div class="flex items-center gap-3">
                <svg v-if="toast.type === 'success'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ toast.message }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CariDokter',
    props: {
        initialDokters: {
            type: Array,
            default: () => []
        },
        initialSpesialis: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            searchQuery: '',
            showFilter: false,
            currentPage: 1,
            perPage: 6,
            isLoading: false,
            dokters: [],
            spesialisList: [],
            selectedSpesialis: null,
            showPendaftaranModal: false,
            selectedDokter: null,
            selectedDokterJadwals: [],
            toast: {
                show: false,
                message: '',
                type: 'success'
            }
        };
    },
    computed: {
        filteredDokters() {
            let result = this.dokters;
            
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(d => 
                    d.nama_dokter.toLowerCase().includes(query) ||
                    (d.spesialisasi && d.spesialisasi.toLowerCase().includes(query))
                );
            }
            
            if (this.selectedSpesialis) {
                result = result.filter(d => d.spesialisasi === this.selectedSpesialis.nama);
            }
            
            return result;
        },
        totalPages() {
            return Math.ceil(this.filteredDokters.length / this.perPage);
        },
        paginatedDokters() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.filteredDokters.slice(start, end);
        },
        visiblePages() {
            const pages = [];
            const start = Math.max(1, this.currentPage - 2);
            const end = Math.min(this.totalPages, start + 4);
            
            for (let i = start; i <= Math.min(end, 5); i++) {
                pages.push(i);
            }
            
            return pages;
        }
    },
    mounted() {
        this.dokters = this.initialDokters.length > 0 ? this.initialDokters : [];
        this.spesialisList = this.initialSpesialis.length > 0 ? this.initialSpesialis : [];
        
        // Fetch data from API if not provided
        if (this.dokters.length === 0) {
            this.fetchDokters();
        }
        if (this.spesialisList.length === 0) {
            this.fetchSpesialis();
        }
    },
    methods: {
        async fetchDokters() {
            this.isLoading = true;
            try {
                const response = await fetch('/api/dokters');
                const data = await response.json();
                this.dokters = data.data || data;
            } catch (error) {
                console.error('Error fetching dokters:', error);
                // Use dummy data for demo
                this.dokters = this.getDummyDokters();
            } finally {
                this.isLoading = false;
            }
        },
        async fetchSpesialis() {
            try {
                const response = await fetch('/api/spesialis');
                const data = await response.json();
                this.spesialisList = data.data || data;
            } catch (error) {
                console.error('Error fetching spesialis:', error);
                // Use dummy data for demo
                this.spesialisList = this.getDummySpesialis();
            }
        },
        filterBySpesialis(item) {
            this.selectedSpesialis = item;
            this.showFilter = false;
            this.currentPage = 1;
        },
        async openPendaftaranModal(dokter) {
            this.selectedDokter = dokter;
            
            // Fetch jadwals for this dokter
            try {
                const response = await fetch(`/api/dokters/${dokter.id}/jadwals`);
                const data = await response.json();
                this.selectedDokterJadwals = data.data || data;
            } catch (error) {
                console.error('Error fetching jadwals:', error);
                // Use dummy data
                this.selectedDokterJadwals = this.getDummyJadwals();
            }
            
            this.showPendaftaranModal = true;
        },
        closePendaftaranModal() {
            this.showPendaftaranModal = false;
            this.selectedDokter = null;
            this.selectedDokterJadwals = [];
        },
        handlePendaftaranSuccess(data) {
            this.closePendaftaranModal();
            this.showToast('Pendaftaran berhasil! Nomor antrian Anda: ' + (data.no_antrian || '-'), 'success');
        },
        handlePendaftaranError(message) {
            this.showToast(message, 'error');
        },
        handleKonsultasiOnline(dokter) {
            // Redirect to online consultation
            window.location.href = '/konsultasi?dokter=' + dokter.id;
        },
        showToast(message, type = 'success') {
            this.toast = { show: true, message, type };
            setTimeout(() => {
                this.toast.show = false;
            }, 5000);
        },
        getDummyDokters() {
            return [
                { id: 1, nama_dokter: 'dr. Anasthasya Ficka Lillononi, M.Psi., Psikolog', spesialisasi: 'Psikologi', rumah_sakit: 'RS Sehat Sentosa Manado', tersedia: true, tipe: 'kunjung' },
                { id: 2, nama_dokter: 'Andy Chandra, SPsi, MPsi', spesialisasi: 'Psikologi', rumah_sakit: 'RS Sehat Sentosa Medan', tersedia: true, tipe: 'kunjung' },
                { id: 3, nama_dokter: 'Baiq Sofia Iswan Azizah, M.Psi., Psikolog', spesialisasi: 'Psikologi', rumah_sakit: 'RS Sehat Sentosa Makassar', tersedia: true, tipe: 'online' },
                { id: 4, nama_dokter: 'Catherine Dowi Surya, S. Psi., Psikolog', spesialisasi: 'Psikologi', rumah_sakit: 'RS Sehat Sentosa Bogor', tersedia: true, tipe: 'online' },
                { id: 5, nama_dokter: 'dr. Citra Hati Leometa, M.Psi., Psi', spesialisasi: 'Psikologi', rumah_sakit: 'RS Sehat Sentosa Lippo Cikarang', tersedia: true, tipe: 'online' },
                { id: 6, nama_dokter: 'Devi Delia, M.Psi., Psikolog', spesialisasi: 'Psikologi', rumah_sakit: 'RS Sehat Sentosa Sriwijaya Palembang', tersedia: true, tipe: 'kunjung' },
            ];
        },
        getDummySpesialis() {
            return [
                { id: 1, nama: 'Akupunktur' },
                { id: 2, nama: 'Andrologi (Reproduksi Pria)' },
                { id: 3, nama: 'Anestesiologi' },
                { id: 4, nama: 'Bedah Anak' },
                { id: 5, nama: 'Bedah Digestif' },
                { id: 6, nama: 'Bedah Onkologi (Kanker)' },
                { id: 7, nama: 'Bedah Plastik' },
                { id: 8, nama: 'Bedah Saraf' },
                { id: 9, nama: 'Dermatologi (Kulit)' },
                { id: 10, nama: 'Farmakologi Klinik' },
                { id: 11, nama: 'Gizi Klinik' },
                { id: 12, nama: 'Kardiologi (Jantung)' },
                { id: 13, nama: 'Kedokteran Gigi' },
                { id: 14, nama: 'Kedokteran Nuklir' },
                { id: 15, nama: 'Laboratorium Medis' },
                { id: 16, nama: 'Neurologi (Otak dan Sistem Saraf)' },
                { id: 17, nama: 'Obstetri dan Ginekologi (Kandungan)' },
                { id: 18, nama: 'Oftalmologi (Mata)' },
                { id: 19, nama: 'Onkologi (Kanker)' },
                { id: 20, nama: 'Ortopedi (Tulang)' },
                { id: 21, nama: 'Pediatrik (Anak)' },
                { id: 22, nama: 'Pengobatan Darurat' },
                { id: 23, nama: 'Penyakit Dalam' },
                { id: 24, nama: 'Psikiatri' },
                { id: 25, nama: 'Psikologi' },
                { id: 26, nama: 'Pulmonologi (Paru)' },
                { id: 27, nama: 'Radiologi' },
                { id: 28, nama: 'Rehabilitasi Medik' },
                { id: 29, nama: 'Urologi' },
            ];
        },
        getDummyJadwals() {
            const today = new Date();
            return [
                { id: 1, tanggal_praktek: today.toISOString().split('T')[0], jam_mulai: '08:00', jam_selesai: '12:00', kuota: 20, terisi: 5 },
                { id: 2, tanggal_praktek: new Date(today.getTime() + 86400000).toISOString().split('T')[0], jam_mulai: '13:00', jam_selesai: '17:00', kuota: 20, terisi: 12 },
                { id: 3, tanggal_praktek: new Date(today.getTime() + 172800000).toISOString().split('T')[0], jam_mulai: '09:00', jam_selesai: '14:00', kuota: 15, terisi: 0 },
            ];
        }
    }
}
</script>
