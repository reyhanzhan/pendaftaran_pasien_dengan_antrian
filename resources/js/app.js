import './bootstrap';
import { createApp } from 'vue';

// Import Vue components
import CariDokter from './components/CariDokter.vue';
import DokterCard from './components/DokterCard.vue';
import SpesialisFilter from './components/SpesialisFilter.vue';
import SearchBar from './components/SearchBar.vue';
import PendaftaranForm from './components/PendaftaranForm.vue';

// Create Vue app and register components globally
const app = createApp({});

app.component('cari-dokter', CariDokter);
app.component('dokter-card', DokterCard);
app.component('spesialis-filter', SpesialisFilter);
app.component('search-bar', SearchBar);
app.component('pendaftaran-form', PendaftaranForm);

// Mount the app if element exists
const el = document.getElementById('app');
if (el) {
    app.mount('#app');
}