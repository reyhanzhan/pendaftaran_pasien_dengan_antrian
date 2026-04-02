<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menu Konsultasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold mb-2">Menu Konsultasi</h1>
                        <p class="text-gray-600 dark:text-gray-400">Pilih dokter dan slot waktu untuk konsultasi</p>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 dark:bg-green-900 dark:text-green-100">
                            <strong>✓ Sukses:</strong> {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 dark:bg-red-900 dark:text-red-100">
                            <strong>✗ Error:</strong> {{ session('error') }}
                        </div>
                    @endif

                    <div class="bg-blue-50 dark:bg-blue-900 border-l-4 border-blue-500 p-6 rounded mb-8">
                        <h2 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">ℹ️ Informasi</h2>
                        <ul class="text-sm text-blue-800 dark:text-blue-200 space-y-2">
                            <li>• Setiap pasien hanya bisa memiliki satu nomor antrian aktif per jadwal</li>
                            <li>• Pilih dokter dan slot waktu yang tersedia</li>
                            <li>• Slot waktu membantu mengurangi waktu tunggu di klinik</li>
                            <li>• Hadir 15 menit sebelum slot waktu Anda</li>
                        </ul>
                    </div>

                    <form action="{{ route('konsultasi.take') }}" method="POST" class="space-y-6" id="konsultasiForm">
                        @csrf
                        
                        <!-- Pilih Dokter -->
                        <div>
                            <label for="dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Dokter</label>
                            <select id="dokter" name="dokter_id" required
                                class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition"
                                onchange="loadJadwals(this.value)">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">
                                        {{ $dokter->nama_dokter }} - {{ $dokter->spesialisasi ?? 'Dokter Umum' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Jadwal -->
                        <div id="jadwalContainer" style="display: none;">
                            <label for="jadwal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Jadwal Praktek</label>
                            <select id="jadwal" name="jadwal_praktek_id" required
                                class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition"
                                onchange="loadSlots(this.value)">
                                <option value="">-- Pilih Jadwal --</option>
                            </select>
                        </div>

                        <!-- Pilih Slot Waktu -->
                        <div id="slotContainer" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Slot Waktu</label>
                            <div id="slotsGrid" class="grid grid-cols-3 md:grid-cols-4 gap-3">
                                <!-- Slots will be loaded dynamically -->
                            </div>
                            <input type="hidden" name="slot_waktu" id="slot_waktu" required>
                            <p class="text-xs text-gray-500 mt-2">* Slot berwarna abu-abu sudah penuh</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit" id="submitBtn" disabled
                                class="w-full px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed text-white font-bold text-lg rounded-lg shadow-lg transition duration-200 transform hover:scale-105 disabled:hover:scale-100">
                                <span class="inline-block mr-2">🎫</span>
                                Ambil Nomor Antrian
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <strong>Catatan:</strong> Jika Anda sudah memiliki nomor antrian aktif untuk jadwal ini, sistem akan
                            menolak pengambilan nomor baru. Selesaikan konsultasi terlebih dahulu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const doktersData = @json($dokters);
        let selectedSlot = null;

        function loadJadwals(dokterId) {
            const jadwalContainer = document.getElementById('jadwalContainer');
            const jadwalSelect = document.getElementById('jadwal');
            const slotContainer = document.getElementById('slotContainer');
            
            if (!dokterId) {
                jadwalContainer.style.display = 'none';
                slotContainer.style.display = 'none';
                return;
            }

            const dokter = doktersData.find(d => d.id == dokterId);
            if (!dokter || !dokter.jadwal_prakteks) {
                jadwalContainer.style.display = 'none';
                return;
            }

            jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
            dokter.jadwal_prakteks.forEach(jadwal => {
                const date = new Date(jadwal.tanggal_praktek);
                const dateStr = date.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                const sisa = jadwal.kuota - jadwal.terisi;
                const option = document.createElement('option');
                option.value = jadwal.id;
                option.textContent = `${dateStr} | ${jadwal.jam_mulai} - ${jadwal.jam_selesai} (Sisa: ${sisa})`;
                option.disabled = sisa <= 0;
                jadwalSelect.appendChild(option);
            });

            jadwalContainer.style.display = 'block';
            slotContainer.style.display = 'none';
            document.getElementById('submitBtn').disabled = true;
        }

        async function loadSlots(jadwalId) {
            const slotContainer = document.getElementById('slotContainer');
            const slotsGrid = document.getElementById('slotsGrid');
            
            if (!jadwalId) {
                slotContainer.style.display = 'none';
                return;
            }

            try {
                const response = await fetch(`/api/pendaftaran/slots/${jadwalId}`);
                const data = await response.json();
                
                slotsGrid.innerHTML = '';
                selectedSlot = null;
                document.getElementById('slot_waktu').value = '';
                document.getElementById('submitBtn').disabled = true;

                if (data.data && data.data.length > 0) {
                    data.data.forEach(slot => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.textContent = slot.waktu;
                        btn.dataset.waktu = slot.waktu;
                        btn.className = slot.terisi 
                            ? 'px-3 py-2 rounded-lg text-sm font-medium border bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200'
                            : 'px-3 py-2 rounded-lg text-sm font-medium border bg-white text-gray-700 hover:bg-blue-50 hover:border-blue-300 border-gray-300 transition slot-btn';
                        
                        if (!slot.terisi) {
                            btn.onclick = () => selectSlot(btn, slot.waktu);
                        }
                        slotsGrid.appendChild(btn);
                    });
                    slotContainer.style.display = 'block';
                }
            } catch (error) {
                console.error('Error loading slots:', error);
            }
        }

        function selectSlot(btn, waktu) {
            document.querySelectorAll('.slot-btn').forEach(b => {
                b.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                b.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
            });
            
            btn.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
            btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
            
            document.getElementById('slot_waktu').value = waktu;
            document.getElementById('submitBtn').disabled = false;
            selectedSlot = waktu;
        }
    </script>
    @endpush
</x-app-layout>
