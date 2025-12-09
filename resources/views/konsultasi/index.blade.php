@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Menu Konsultasi</h2>
    <form action="{{ route('konsultasi.take') }}" method="POST">
        @csrf
        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg">Ambil Nomor Antrian</button>
    </form>
</div>
@endsection