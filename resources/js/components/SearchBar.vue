<template>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input 
            type="text" 
            v-model="searchQuery"
            @input="$emit('update:modelValue', searchQuery)"
            :placeholder="placeholder"
            class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white shadow-sm"
        />
        <button 
            v-if="showFilter"
            @click="$emit('toggle-filter')"
            class="absolute inset-y-0 right-0 pr-4 flex items-center text-blue-600 hover:text-blue-800 font-medium"
        >
            Filter
        </button>
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    props: {
        modelValue: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: 'Ketik nama dokter atau gunakan filter'
        },
        showFilter: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            searchQuery: this.modelValue
        };
    },
    watch: {
        modelValue(val) {
            this.searchQuery = val;
        }
    },
    emits: ['update:modelValue', 'toggle-filter']
}
</script>
