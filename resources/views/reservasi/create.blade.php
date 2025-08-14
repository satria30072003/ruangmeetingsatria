@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Buat Reservasi Baru</h3>

    <form action="{{ route('reservasi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_pemesan">Nama Pemesan</label>
            <input type="text" class="form-control" name="nama_pemesan" value="{{ old('nama_pemesan') }}">
        </div>

        <div class="mb-3">
            <label for="room_id">Ruangan</label>
            <select name="room_id" class="form-control">
                <option value="">-- Pilih Ruangan --</option>
                @foreach($rooms as $room)
                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
        </div>

        <div class="mb-3">
            <label for="waktu_mulai">Waktu Mulai</label>
            <input type="time" class="form-control" name="waktu_mulai" value="{{ old('waktu_mulai') }}">
        </div>

        <div class="mb-3">
            <label for="waktu_selesai">Waktu Selesai</label>
            <input type="time" class="form-control" name="waktu_selesai" value="{{ old('waktu_selesai') }}">
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="no_whatsapp">No WhatsApp</label>
            <input type="text" class="form-control" name="no_whatsapp" value="{{ old('no_whatsapp') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection