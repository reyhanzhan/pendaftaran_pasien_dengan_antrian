<template>
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden">
        <!-- Type Badge -->
        <div class="px-5 pt-4 pb-2">
            <span v-if="dokter.tipe === 'online'" class="inline-flex items-center text-xs font-medium text-blue-700">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Online & Kunjungi Rumah Sakit
            </span>
            <span v-else class="inline-flex items-center text-xs font-medium text-gray-600">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
                Kunjungi Rumah Sakit
            </span>
        </div>
        
        <!-- Doctor Info -->
        <div class="px-5 pb-4">
            <div class="flex gap-4">
                <!-- Photo -->
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center overflow-hidden ring-2 ring-blue-100">
                        <img 
                            v-if="dokter.foto" 
                            :src="dokter.foto" 
                            :alt="dokter.nama_dokter"
                            class="w-full h-full object-cover"
                        />
                        <svg v-else class="w-12 h-12 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Details -->
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-900 text-base leading-tight mb-2 line-clamp-2">{{ dokter.nama_dokter }}</h3>
                    
                    <!-- Specialization Tags -->
                    <div class="flex flex-wrap gap-1 mb-2">
                        <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-700 text-xs rounded-full font-medium">
                            {{ dokter.spesialisasi || 'Dokter Umum' }}
                        </span>
                    </div>
                    
                    <!-- Hospital -->
                    <p class="text-sm text-gray-500 mb-2">{{ dokter.rumah_sakit || 'RS Sehat Sentosa' }}</p>
                    
                    <!-- Availability -->
                    <div class="flex items-center gap-1 text-sm">
                        <span class="text-gray-500">Tersedia:</span>
                        <span :class="dokter.tersedia ? 'text-green-600 font-medium' : 'text-red-500'">
                            {{ dokter.tersedia ? 'Tersedia hari ini' : 'Tidak tersedia' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="px-5 pb-5 flex gap-2">
            <button 
                v-if="dokter.tipe === 'online' || dokter.konsultasi_online"
                @click="$emit('konsultasi-online', dokter)"
                class="flex-1 px-4 py-2.5 border-2 border-blue-700 text-blue-700 font-semibold rounded-lg hover:bg-blue-50 transition text-sm"
            >
                Konsultasi Online
            </button>
            <button 
                @click="$emit('pesan-janji', dokter)"
                class="flex-1 px-4 py-2.5 bg-blue-700 text-white font-semibold rounded-lg hover:bg-blue-800 transition text-sm"
            >
                Pesan Janji Temu
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DokterCard',
    props: {
        dokter: {
            type: Object,
            required: true
        }
    },
    emits: ['konsultasi-online', 'pesan-janji']
}
</script>
