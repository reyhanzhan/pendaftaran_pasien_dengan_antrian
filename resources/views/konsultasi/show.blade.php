@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Nomor Antrian Anda</h2>

    @if($nomor)
        <div class="p-6 bg-green-50 border-l-4 border-green-500 rounded">
            <p class="text-lg">Nomor Anda: <span class="font-extrabold text-3xl">{{ $nomor }}</span></p>
            <p class="mt-2 text-sm text-gray-600">Simpan nomor ini dan tunggu panggilan.</p>
        </div>
    @else
        <p class="text-gray-600">Belum ada nomor antrian. Silakan kembali dan ambil nomor.</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('konsultasi.index') }}" class="text-blue-600 underline">Kembali</a>
    </div>
</div>
@endsection