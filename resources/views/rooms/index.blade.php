@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')

<div class="container d-flex justify-content-center">
    <div class="w-100" style="max-width: 900px;">

        <h2 class="mb-4 text-center">Daftar Ruangan</h2>

        <!-- Tombol Tambah Ruangan di kiri -->
        <div class="mb-3 text-start">
            <a href="{{ route('rooms.create') }}" class="btn btn-primary">+ Tambah Ruangan</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->location }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ $room->description }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <!-- Tombol Kembali di kiri -->
        <div class="mt-4 text-start">
            <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

    </div>
</div>

@endsection