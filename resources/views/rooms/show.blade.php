@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <a href="{{ route('rooms.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow p-4">
        <h2>{{ $room->name }}</h2>
        <p><strong>Lokasi:</strong> {{ $room->location }}</p>
        <p><strong>Kapasitas:</strong> {{ $room->capacity }} orang</p>
        <p><strong>Deskripsi:</strong> {{ $room->description ?? 'Tidak ada deskripsi.' }}</p>

        {{-- Status ketersediaan dan tombol ubah --}}
        <div class="mt-3 d-flex align-items-center">
            <strong class="me-2">Status:</strong>
            @if ($room->status)
            <span class="badge bg-success me-3">Tersedia</span>
            @else
            <span class="badge bg-danger me-3">Tidak Tersedia</span>
            @endif

            <form action="{{ route('rooms.toggleStatus', $room->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-primary btn-sm">
                    @if ($room->status)
                    Tandai Tidak Tersedia
                    @else
                    Tandai Tersedia
                    @endif
                </button>
            </form>
        </div>

        {{-- Gambar ruangan --}}
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
        <p class="text-muted mt-4">Belum ada gambar ruangan.</p>
        @endif
    </div>
</div>
@endsection