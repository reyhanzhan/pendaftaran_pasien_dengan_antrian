<template>
    <div class="fixed inset-0 z-50 overflow-y-auto" v-if="show">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" @click="$emit('close')">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Pendaftaran Pasien</h3>
                    <button @click="$emit('close')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Doctor Info -->
                <div v-if="dokter" class="flex items-center gap-4 p-4 bg-blue-50 rounded-xl mb-6">
                    <div class="w-12 h-12 rounded-full bg-blue-200 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">{{ dokter.nama_dokter }}</h4>
                        <p class="text-sm text-blue-600">{{ dokter.spesialisasi || 'Dokter Umum' }}</p>
                    </div>
                </div>

                <form @submit.prevent="submitForm" class="space-y-4">
                    <!-- NIK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK (Nomor Induk Kependudukan)</label>
                        <input 
                            type="text" 
                            v-model="form.nik"
                            maxlength="16"
                            @input="validateNik"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Masukkan 16 digit NIK"
                            required
                        />
                        <p v-if="nikError" class="mt-1 text-sm text-red-600">{{ nikError }}</p>
                        <p v-else-if="nikValid" class="mt-1 text-sm text-green-600">✓ NIK Valid</p>
                    </div>

                    <!-- Nama Pasien -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Pasien</label>
                        <input 
                            type="text" 
                            v-model="form.nama_pasien"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Nama sesuai KTP"
                            required
                        />
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" v-model="form.jenis_kelamin" value="L" class="text-blue-600 focus:ring-blue-500" required />
                                <span class="ml-2 text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" v-model="form.jenis_kelamin" value="P" class="text-blue-600 focus:ring-blue-500" />
                                <span class="ml-2 text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input 
                            type="tel" 
                            v-model="form.no_telp"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="08xxxxxxxxxx"
                            required
                        />
                    </div>

                    <!-- Pilih Jadwal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Jadwal Praktek</label>
                        <select 
                            v-model="form.jadwal_praktek_id"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            required
                        >
                            <option value="">-- Pilih Jadwal --</option>
                            <option 
                                v-for="jadwal in availableJadwals" 
                                :key="jadwal.id" 
                                :value="jadwal.id"
                                :disabled="!jadwal.tersedia"
                            >
                                {{ formatDate(jadwal.tanggal_praktek) }} | {{ jadwal.jam_mulai }} - {{ jadwal.jam_selesai }} 
                                (Sisa slot: {{ jadwal.kuota - jadwal.terisi }})
                            </option>
                        </select>
                    </div>

                    <!-- Pilih Slot Waktu -->
                    <div v-if="form.jadwal_praktek_id && selectedJadwal">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Slot Waktu</label>
                        <div class="grid grid-cols-3 gap-2">
                            <button
                                type="button"
                                v-for="slot in timeSlots"
                                :key="slot.waktu"
                                @click="selectTimeSlot(slot)"
                                :disabled="slot.terisi"
                                :class="[
                                    'px-3 py-2 rounded-lg text-sm font-medium border transition',
                                    form.slot_waktu === slot.waktu 
                                        ? 'bg-blue-600 text-white border-blue-600' 
                                        : slot.terisi 
                                            ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' 
                                            : 'bg-white text-gray-700 hover:bg-blue-50 hover:border-blue-300 border-gray-300'
                                ]"
                            >
                                {{ slot.waktu }}
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">* Slot berwarna abu-abu sudah penuh</p>
                    </div>

                    <!-- Keluhan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
                        <textarea 
                            v-model="form.keluhan"
                            rows="3"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                            placeholder="Ceritakan keluhan Anda..."
                        ></textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4">
                        <button 
                            type="submit"
                            :disabled="isSubmitting || !isFormValid"
                            class="w-full py-3 px-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="isSubmitting" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                            <span v-else>Daftar Sekarang</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PendaftaranForm',
    props: {
        show: Boolean,
        dokter: Object,
        jadwals: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            form: {
                nik: '',
                nama_pasien: '',
                jenis_kelamin: '',
                no_telp: '',
                jadwal_praktek_id: '',
                slot_waktu: '',
                keluhan: ''
            },
            nikError: '',
            nikValid: false,
            isSubmitting: false,
            timeSlots: []
        };
    },
    computed: {
        availableJadwals() {
            return this.jadwals.map(j => ({
                ...j,
                tersedia: (j.kuota - j.terisi) > 0
            }));
        },
        selectedJadwal() {
            return this.jadwals.find(j => j.id === parseInt(this.form.jadwal_praktek_id));
        },
        isFormValid() {
            return this.nikValid && 
                   this.form.nama_pasien && 
                   this.form.jenis_kelamin && 
                   this.form.no_telp && 
                   this.form.jadwal_praktek_id &&
                   this.form.slot_waktu;
        }
    },
    watch: {
        'form.jadwal_praktek_id'(newVal) {
            if (newVal) {
                this.generateTimeSlots();
            } else {
                this.timeSlots = [];
                this.form.slot_waktu = '';
            }
        }
    },
    methods: {
        validateNik() {
            const nik = this.form.nik.replace(/\D/g, '');
            this.form.nik = nik;
            
            if (nik.length === 0) {
                this.nikError = '';
                this.nikValid = false;
                return;
            }
            
            if (nik.length !== 16) {
                this.nikError = 'NIK harus 16 digit';
                this.nikValid = false;
                return;
            }
            
            // Validate NIK structure (basic validation)
            const provinsi = parseInt(nik.substring(0, 2));
            const kabupaten = parseInt(nik.substring(2, 4));
            const kecamatan = parseInt(nik.substring(4, 6));
            const tanggal = parseInt(nik.substring(6, 8));
            const bulan = parseInt(nik.substring(8, 10));
            const tahun = parseInt(nik.substring(10, 12));
            
            // Check if values make sense
            if (provinsi < 11 || provinsi > 94) {
                this.nikError = 'Kode provinsi tidak valid';
                this.nikValid = false;
                return;
            }
            
            // For women, date is added by 40
            const actualDate = tanggal > 40 ? tanggal - 40 : tanggal;
            if (actualDate < 1 || actualDate > 31) {
                this.nikError = 'Format tanggal lahir tidak valid';
                this.nikValid = false;
                return;
            }
            
            if (bulan < 1 || bulan > 12) {
                this.nikError = 'Format bulan lahir tidak valid';
                this.nikValid = false;
                return;
            }
            
            this.nikError = '';
            this.nikValid = true;
        },
        generateTimeSlots() {
            const jadwal = this.selectedJadwal;
            if (!jadwal) return;
            
            const slots = [];
            const [startHour, startMinute] = jadwal.jam_mulai.split(':').map(Number);
            const [endHour, endMinute] = jadwal.jam_selesai.split(':').map(Number);
            
            let currentHour = startHour;
            let currentMinute = startMinute;
            
            // Generate 1-hour slots
            while (currentHour < endHour || (currentHour === endHour && currentMinute < endMinute)) {
                const slotStart = `${String(currentHour).padStart(2, '0')}:${String(currentMinute).padStart(2, '0')}`;
                
                // Move to next hour
                currentHour += 1;
                if (currentHour > endHour || (currentHour === endHour && currentMinute > endMinute)) {
                    currentHour = endHour;
                    currentMinute = endMinute;
                }
                
                const slotEnd = `${String(currentHour).padStart(2, '0')}:${String(currentMinute).padStart(2, '0')}`;
                
                // Simulate random availability (in real app, this should come from backend)
                const terisi = Math.random() > 0.6;
                
                slots.push({
                    waktu: `${slotStart}`,
                    slot_start: slotStart,
                    slot_end: slotEnd,
                    terisi: terisi
                });
            }
            
            this.timeSlots = slots;
        },
        selectTimeSlot(slot) {
            if (!slot.terisi) {
                this.form.slot_waktu = slot.waktu;
            }
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
        },
        async submitForm() {
            if (!this.isFormValid) return;
            
            this.isSubmitting = true;
            
            try {
                const response = await fetch('/api/pendaftaran', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        ...this.form,
                        dokter_id: this.dokter?.id
                    })
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    this.$emit('success', data);
                    this.resetForm();
                } else {
                    this.$emit('error', data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                this.$emit('error', 'Terjadi kesalahan jaringan');
            } finally {
                this.isSubmitting = false;
            }
        },
        resetForm() {
            this.form = {
                nik: '',
                nama_pasien: '',
                jenis_kelamin: '',
                no_telp: '',
                jadwal_praktek_id: '',
                slot_waktu: '',
                keluhan: ''
            };
            this.nikError = '';
            this.nikValid = false;
            this.timeSlots = [];
        }
    },
    emits: ['close', 'success', 'error']
}
</script>
