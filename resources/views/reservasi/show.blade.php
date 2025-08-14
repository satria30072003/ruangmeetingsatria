@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <a href="{{ route('landing') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow p-4">
        <h2>{{ $room->name }}</h2>
        <p><strong>Lokasi:</strong> {{ $room->location }}</p>
        <p><strong>Kapasitas:</strong> {{ $room->capacity }} orang</p>
        <p><strong>Deskripsi:</strong> {{ $room->description ?? 'Tidak ada deskripsi.' }}</p>
        <p><strong>Nama Pemesan:</strong> {{ $reservasi->nama_pemesan }}</p>
        <p><strong>Email:</strong> {{ $reservasi->email }}</p>
        <p><strong>No WhatsApp:</strong> {{ $reservasi->no_whatsapp }}</p>
        <p><strong>Ruangan:</strong> {{ $room->name }}</p>
        <p><strong>Status:</strong> {{ ucfirst($reservasi->status) }}</p>
        <p><strong>Tanggal Reservasi:</strong> {{ $reservasi->tanggal }}</p>
        <p><strong>Waktu Mulai:</strong> {{ $reservasi->waktu_mulai }}</p>
        <p><strong>Waktu Selesai:</strong> {{ $reservasi->waktu_selesai }}</p>

        @if ($room->images->count())
        <div class="mt-4">
            <h5>Gambar Ruangan:</h5>
            <div class="row">
                @foreach ($room->images as $image)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('uploads/' . $image->image_path) }}" class="img-fluid rounded shadow-sm"
                        alt="Gambar ruangan">
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-muted">Belum ada gambar ruangan.</p>
        @endif
    </div>
</div>
</div>
@endsection