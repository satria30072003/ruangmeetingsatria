<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
    'nama_pemesan',
    'room_id',
    'tanggal',
    'waktu_mulai',
    'waktu_selesai',
    'email',
    'no_whatsapp',
    'status',
    'user_id',
];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}