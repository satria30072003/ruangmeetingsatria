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
        // Validasi data
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'email' => 'required|email',
            'no_whatsapp' => 'required',
            'status' => 'nullable',
        ]);

        // Update reservasi
        $reservasi->update($request->all());

        // Siapkan data dari DB
        $roomName    = $reservasi->room->name ?? 'Ruangan tidak diketahui';
        $tanggal     = date('d-m-Y', strtotime($reservasi->tanggal));
        $waktuMulai  = $reservasi->waktu_mulai;
        $waktuSelesai = $reservasi->waktu_selesai;

        // Nomor tujuan (user + admin)
        $targets = $reservasi->no_whatsapp . ',' . env('ADMIN_WA');

        // API Key dari .env
        $token = env('WHATSAPP_API_KEY');

        // Kalau status disetujui
        if ($request->status === 'disetujui') {
            $message = "✅ *Reservasi Disetujui* ✅\n\n"
                . "Detail reservasi:\n"
                . "📍 Ruangan : {$roomName}\n"
                . "📅 Tanggal : {$tanggal}\n"
                . "⏰ Jam     : {$waktuMulai} - {$waktuSelesai}\n\n"
                . "Silakan hadir sesuai jadwal 🙏";

            $this->sendWhatsapp($targets, $message, $token);
        }

        // Kalau status ditolak
if ($request->status === 'ditolak') {
    $message = "❌ *Reservasi Ditolak* ❌\n\n"
        . "Detail reservasi:\n"
        . "📍 Ruangan : {$roomName}\n"
        . "📅 Tanggal : {$tanggal}\n"
        . "⏰ Jam     : {$waktuMulai} - {$waktuSelesai}\n\n"
        . "Mohon maaf, reservasi Anda tidak dapat diproses 🙏";

    // kirim ke user + admin
    $targets = $reservasi->no_whatsapp . ',' . env('ADMIN_WA');

    $response = WhatsappHelper::sendMessage($targets, $message);

    if (!$response || (isset($response['status']) && $response['status'] != true)) {
        return redirect()
            ->route('reservasi.index')
            ->with('error', '❌ Reservasi berhasil ditolak, tapi notifikasi WA gagal terkirim.');
    }

    return redirect()
        ->route('reservasi.index')
        ->with('success', '❌ Reservasi ditolak dan notifikasi WA berhasil terkirim.');
}


        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Fungsi bantu untuk kirim WhatsApp via Fonnte
     */
    private function sendWhatsapp($target, $message, $token)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . $token,
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return response()->json([
                'error' => 'Gagal mengirim pesan WhatsApp: ' . curl_error($curl)
            ], 500);
        } else {
            $responseData = json_decode($response, true);
            if (isset($responseData['error'])) {
                return response()->json([
                    'error' => 'Gagal mengirim pesan WhatsApp: ' . $responseData['error']
                ], 500);
            }
            return response()->json(['success' => 'Pesan WhatsApp berhasil dikirim.']);
        }

        curl_close($curl);
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

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil disetujui.');
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