@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Tambah Ruangan Baru</h3>

    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Ruangan</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Kapasitas</label>
            <input type="number" name="capacity" id="capacity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Ruangan</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection