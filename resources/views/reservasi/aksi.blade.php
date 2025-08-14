<a href="{{ route('reservasi.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
<a href="{{ route('reservasi.show', $r->id) }}" class="btn btn-sm btn-warning">Detail</a>

<button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('reservasi.destroy', $r->id) }}">
    Hapus
</button>