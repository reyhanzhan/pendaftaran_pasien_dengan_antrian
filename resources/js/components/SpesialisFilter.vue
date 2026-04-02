<template>
    <div class="bg-gray-50 border-t border-gray-100 py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-sm font-medium text-gray-500 mb-6">Atau Cari Berdasarkan Spesialis</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Column A-B -->
                <div>
                    <div v-for="letter in ['A', 'B']" :key="letter" class="mb-6">
                        <h4 class="text-2xl font-bold text-blue-900 mb-3">{{ letter }}</h4>
                        <ul class="space-y-2">
                            <li 
                                v-for="item in getSpesialisByLetter(letter)" 
                                :key="item.id"
                                @click="selectSpesialis(item)"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600 cursor-pointer py-1 transition group"
                            >
                                <span>{{ item.nama }}</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Column D-K -->
                <div>
                    <div v-for="letter in ['D', 'F', 'G', 'K']" :key="letter" class="mb-6">
                        <h4 class="text-2xl font-bold text-blue-900 mb-3">{{ letter }}</h4>
                        <ul class="space-y-2">
                            <li 
                                v-for="item in getSpesialisByLetter(letter)" 
                                :key="item.id"
                                @click="selectSpesialis(item)"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600 cursor-pointer py-1 transition group"
                            >
                                <span>{{ item.nama }}</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Column L-O -->
                <div>
                    <div v-for="letter in ['L', 'N', 'O']" :key="letter" class="mb-6">
                        <h4 class="text-2xl font-bold text-blue-900 mb-3">{{ letter }}</h4>
                        <ul class="space-y-2">
                            <li 
                                v-for="item in getSpesialisByLetter(letter)" 
                                :key="item.id"
                                @click="selectSpesialis(item)"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600 cursor-pointer py-1 transition group"
                            >
                                <span>{{ item.nama }}</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Column P-U -->
                <div>
                    <div v-for="letter in ['P', 'R', 'U']" :key="letter" class="mb-6">
                        <h4 class="text-2xl font-bold text-blue-900 mb-3">{{ letter }}</h4>
                        <ul class="space-y-2">
                            <li 
                                v-for="item in getSpesialisByLetter(letter)" 
                                :key="item.id"
                                @click="selectSpesialis(item)"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600 cursor-pointer py-1 transition group"
                            >
                                <span>{{ item.nama }}</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SpesialisFilter',
    props: {
        spesialisList: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        getSpesialisByLetter(letter) {
            return this.spesialisList.filter(s => s.nama.charAt(0).toUpperCase() === letter);
        },
        selectSpesialis(item) {
            this.$emit('select', item);
        }
    },
    emits: ['select']
}
</script>
