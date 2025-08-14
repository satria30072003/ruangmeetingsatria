<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\RoomImage;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }
    public function create()
    {
        return view('rooms.create');
    }

    
public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required',
        'location' => 'required',
        'capacity' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // hanya 1 gambar
    ]);

    // Simpan data ruangan
    $room = Room::create([
        'name' => $request->name,
        'location' => $request->location,
        'capacity' => $request->capacity,
        'description' => $request->description,
    ]);

    // Simpan gambar jika ada
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);

        // Simpan ke tabel room_images
        RoomImage::create([
            'room_id' => $room->id,
            'image_path' => $imageName,
        ]);
    }

    return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan!');
}

//ujung tambahan upload gambar




    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dihapus.');
    }

    public function search()
    {
        return view('rooms.search');
    }

    public function searchRooms(Request $request)
    {
        $query = $request->input('query');
        $rooms = Room::where('name', 'like', '%' . $query . '%')->get();
        return view('rooms.search', compact('rooms'));
    }
    public function show($id)
{
    $room = Room::with('images')->findOrFail($id); // penting: with('images') biar gambarnya ke-load

    return view('rooms.show', compact('room'));
}

    public function reserve(Room $room)
    {
        return view('rooms.reserve', compact('room'));
    }

    //edit ruangan dan update
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diperbarui!');
    }

    public function toggleStatus($id)
{
    $room = Room::findOrFail($id);
    $room->status = !$room->status;
    $room->save();

    return redirect()->back()->with('success', 'Status ruangan berhasil diperbarui!');
}
public function getData(Request $request)
{
    $data = \App\Models\Reservasi::with('room')->latest();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('room_name', function ($row) {
            return $row->room->name ?? '-';
        })
        ->addColumn('aksi', function ($row) {
            return view('reservasi.partials.aksi', compact('row'))->render();
        })
        ->rawColumns(['aksi'])
        ->make(true);
}


}