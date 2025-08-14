<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Room;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\WhatsappHelper;



class ReservasiController extends Controller
{
    public function index()
    {
        return view('reservasi.index');
    }

    public function datatables()
    {
        $user = Auth::user();
        $query = Reservasi::with('room')->latest();

        if ($user->role !== 'admin') {
            // User biasa hanya dapat data miliknya sendiri
            $query->where('user_id', $user->id);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('room_name', fn($r) => $r->room->name ?? '-')
            ->addColumn('status', function ($r) {
                switch ($r->status) {
                    case 'disetujui':
                        return '<span class="badge bg-success">Disetujui</span>';
                    case 'ditolak':
                        return '<span class="badge bg-danger">Ditolak</span>';
                    default:
                        return '<span class="badge bg-secondary">Menunggu</span>';
                }
            })
            ->addColumn('aksi', function ($r) use ($user) {
                // Tombol edit & hapus hanya tampil kalau admin atau pemilik data
                if ($user->role === 'admin' || $r->user_id === $user->id) {
                    return view('reservasi.aksi', compact('r'))->render();
                }
                return ''; // Tidak tampil tombol aksi kalau bukan owner/admin
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }


    public function create()
    {
        $rooms = Room::all();
        return view('reservasi.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'email' => 'required|email|max:255',
            'no_whatsapp' => 'required|max:20',
            'status' => 'nullable|in:menunggu,disetujui,ditolak'
        ]);

        $reservasi = Reservasi::create([
            'nama_pemesan' => $request->nama_pemesan,
            'room_id' => $request->room_id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'status' => 'menunggu',
            'user_id' => Auth::id(), // Simpan ID user yang membuat reservasi
        ]);

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dibuat.');
    }

    public function edit(Reservasi $reservasi)
    {
        $rooms = Room::all();
        return view('reservasi.edit', compact('reservasi', 'rooms'));
    }

    public function update(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'email' => 'required|email|max:255',
            'no_whatsapp' => 'required|max:20',
            'status' => 'nullable|in:menunggu,disetujui,ditolak'

        ]);

        $reservasi->update($request->all());

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();
        return response()->json(['success' => 'Reservasi berhasil dihapus.']);
    }



    public function approve(Request $request, Reservasi $reservasi)
    {
        // Update status menjadi disetujui
        $reservasi->update(['status' => 'disetujui']);

        // Ambil data ruangan
        $room = $reservasi->room;

        // Nomor WA admin dari .env
        $adminNumber = env('ADMIN_WA');

        // Nomor WA customer dari tabel reservasi
        $customerNumber = $reservasi->no_whatsapp;

        // Token API WhatsApp (Fonnte)
        $token = env('WHATSAPP_API_KEY');

        // Pesan untuk admin
        $adminMessage = "Reservasi Disetujui ✅\n\n" .
            "Nama: {$reservasi->nama_pemesan}\n" .
            "Ruangan: {$room->name}\n" .
            "Tanggal: {$reservasi->tanggal}\n" .
            "Waktu: {$reservasi->waktu_mulai} - {$reservasi->waktu_selesai}";

        // Pesan untuk customer
        $userMessage = "Halo {$reservasi->nama_pemesan}, reservasi Anda untuk ruangan '{$room->name}' pada {$reservasi->tanggal} telah *disetujui* ✅.";

        // Fungsi kirim WA via Fonnte + logging
        $sendWhatsapp = function ($target, $message) use ($token) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.fonnte.com/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => [
                    'target' => $target,
                    'message' => $message,
                ],
                CURLOPT_HTTPHEADER => [
                    "Authorization: $token"
                ],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
        };

        // Kirim ke admin
        if (!empty($adminNumber)) {
            $sendWhatsapp($adminNumber, $adminMessage);
        }

        // Kirim ke customer
        if (!empty($customerNumber)) {
            $sendWhatsapp($customerNumber, $userMessage);
        }

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi disetujui & WA terkirim.');
    }



    public function getRoomUsageData()
    {
        $result = DB::table('rooms')
            ->leftJoin('reservasis', 'rooms.id', '=', 'reservasis.room_id')
            ->select('rooms.name', DB::raw('COUNT(reservasis.id) as total'))
            ->groupBy('rooms.id', 'rooms.name')
            ->get();

        $response = [
            'label' => $result->pluck('name'),
            'data' => $result->pluck('total'),
        ];

        return response()->json($response);
    }
    public function show($id)
    {
        // Ambil reservasi beserta data ruangan terkait
        $reservasi = Reservasi::with('room')->findOrFail($id);

        // Ambil data room dari relasi
        $room = $reservasi->room;

        // Kirim ke view
        return view('reservasi.show', compact('reservasi', 'room'));
    }
}
