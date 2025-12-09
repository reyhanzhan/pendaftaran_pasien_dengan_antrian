<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('jadwal praktik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    {{-- start konten --}}

    <h3>Jadwal Dokter</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Dokter</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Kuota Tersisa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwals as $jadwal)
                <tr>
                    <td>{{ $jadwal->dokter->nama_dokter }}</td>
                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_praktek)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                    {{-- <td>{{ $jadwal->kuota - $jadwal->antrian_pasiens_count }}</td> --}}
                    <td>
                        @if ($jadwal->kuota - $jadwal->antrian_pasiens_count > 0)
                            <form action="{{ route('antrian.daftar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jadwal_praktek_id" value="{{ $jadwal->id }}">
                                <input type="hidden" name="tanggal_praktek" value="{{ $jadwal->tanggal_praktek }}">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>
                        @else
                            <button class="btn btn-danger" disabled>Penuh</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
