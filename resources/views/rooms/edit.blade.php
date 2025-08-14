@extends('layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Ruangan</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ups!</strong> Ada kesalahan:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- karena ini form update --}}

        <div class="mb-3">
            <label class="form-label">Nama Ruangan</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $room->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" required
                value="{{ old('location', $room->location) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" name="capacity" class="form-control" required
                value="{{ old('capacity', $room->capacity) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', $room->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection