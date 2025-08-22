@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Edit Reservasi</h3>

    <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_pemesan">Nama Pemesan</label>
            <input type="text" class="form-control" name="nama_pemesan"
                value="{{ old('nama_pemesan', $reservasi->nama_pemesan) }}">
        </div>

        <div class="mb-3">
            <label for="room_id">Ruangan</label>
            <select name="room_id" class="form-control">
                <option value="">-- Pilih Ruangan --</option>
                @foreach($rooms as $room)
                <option value="{{ $room->id }}"
                    {{ old('room_id', $reservasi->room_id) == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $reservasi->tanggal) }}">
        </div>

        <div class="mb-3">
            <label for="waktu_mulai">Waktu Mulai</label>
            <input type="time" class="form-control" name="waktu_mulai"
                value="{{ old('waktu_mulai', $reservasi->waktu_mulai) }}">
        </div>

        <div class="mb-3">
            <label for="waktu_selesai">Waktu Selesai</label>
            <input type="time" class="form-control" name="waktu_selesai"
                value="{{ old('waktu_selesai', $reservasi->waktu_selesai) }}">
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $reservasi->email) }}">
        </div>

        <div class="mb-3">
            <label for="no_whatsapp">No WhatsApp</label>
            <input type="text" class="form-control" name="no_whatsapp"
                value="{{ old('no_whatsapp', $reservasi->no_whatsapp) }}">
        </div>
        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="menunggu" {{ old('status', $reservasi->status) == 'menunggu' ? 'selected' : '' }}>
                    Menunggu</option>
                <option value="disetujui" {{ old('status', $reservasi->status) == 'disetujui' ? 'selected' : '' }}>
                    Disetujui</option>
                <option value="ditolak" {{ old('status', $reservasi->status) == 'ditolak' ? 'selected' : '' }}>Ditolak
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
halo