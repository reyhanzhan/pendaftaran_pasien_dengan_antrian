<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $nik = '';
    public string $no_telp = '';
    public string $jenis_kelamin = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $nikError = '';

    /**
     * Validate NIK format
     */
    public function validateNik(): void
    {
        $this->nikError = '';
        $nik = preg_replace('/\D/', '', $this->nik);
        $this->nik = $nik;
        
        if (strlen($nik) === 0) return;
        
        if (strlen($nik) !== 16) {
            $this->nikError = 'NIK harus 16 digit';
            return;
        }
        
        // Province code validation (11-94)
        $provinsi = (int) substr($nik, 0, 2);
        if ($provinsi < 11 || $provinsi > 94) {
            $this->nikError = 'Kode provinsi tidak valid';
            return;
        }
        
        // Date validation
        $tanggal = (int) substr($nik, 6, 2);
        $bulan = (int) substr($nik, 8, 2);
        $actualTanggal = $tanggal > 40 ? $tanggal - 40 : $tanggal;
        
        if ($actualTanggal < 1 || $actualTanggal > 31) {
            $this->nikError = 'Format tanggal lahir tidak valid';
            return;
        }
        
        if ($bulan < 1 || $bulan > 12) {
            $this->nikError = 'Format bulan lahir tidak valid';
            return;
        }
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nik' => ['required', 'string', 'size:16', 'unique:'.User::class],
            'no_telp' => ['required', 'string', 'max:20'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full">
    <div class="text-center mb-8">
        <div class="bg-gradient-to-br from-blue-100 to-blue-50 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 text-blue-600 shadow-md">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900">Buat Akun Baru</h2>
        <p class="text-gray-500 text-sm mt-2">Lengkapi data diri Anda untuk mulai mendaftar.</p>
    </div>

    <form wire:submit="register" class="space-y-5">
        
        <!-- Nama Lengkap -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nama Lengkap') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-gray-400 sm:text-sm"
                    placeholder="Nama sesuai KTP" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- NIK -->
        <div>
            <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">{{ __('NIK (Nomor Induk Kependudukan)') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                    </svg>
                </div>
                <input wire:model="nik" wire:blur="validateNik" id="nik" type="text" name="nik" maxlength="16" required
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-gray-400 sm:text-sm"
                    placeholder="16 digit NIK" />
            </div>
            @if($nikError)
                <p class="mt-1 text-sm text-red-600">{{ $nikError }}</p>
            @elseif(strlen($nik) === 16 && !$nikError)
                <p class="mt-1 text-sm text-green-600">✓ NIK Valid</p>
            @endif
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>

        <!-- No. Telepon -->
        <div>
            <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nomor Telepon') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <input wire:model="no_telp" id="no_telp" type="tel" name="no_telp" required
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-gray-400 sm:text-sm"
                    placeholder="08xxxxxxxxxx" />
            </div>
            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Jenis Kelamin') }}</label>
            <div class="flex gap-6">
                <label class="flex items-center cursor-pointer group">
                    <input wire:model="jenis_kelamin" type="radio" name="jenis_kelamin" value="L" required
                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                    <span class="ml-2 text-gray-700 group-hover:text-gray-900">Laki-laki</span>
                </label>
                <label class="flex items-center cursor-pointer group">
                    <input wire:model="jenis_kelamin" type="radio" name="jenis_kelamin" value="P"
                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
                    <span class="ml-2 text-gray-700 group-hover:text-gray-900">Perempuan</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email Address') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <input wire:model="email" id="email" type="email" name="email" required autocomplete="username"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-gray-400 sm:text-sm"
                    placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-gray-400 sm:text-sm"
                    placeholder="Minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Konfirmasi Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-gray-400 sm:text-sm"
                    placeholder="Ulangi password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Info -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <p class="text-sm text-blue-800 font-medium">
                <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                Data pribadi Anda akan digunakan untuk keperluan pendaftaran antrian dan rekam medis.
            </p>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">
                
                <span wire:loading.remove>Daftar Akun</span>

                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                </span>
            </button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm text-gray-600">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" wire:navigate class="font-bold text-blue-600 hover:text-blue-500 hover:underline transition duration-200">
                Masuk Disini
            </a>
        </p>
    </div>
</div>