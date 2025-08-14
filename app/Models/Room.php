<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Room extends Model
{



    use HasFactory;

    protected $table = 'rooms';

    // Kolom yang bisa diisi
    protected $fillable = [
        'name',
        'location',
        'capacity',
        'description'
    ];
    // Room.php
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    // RoomImage.php
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservasi::class, 'room_id');
    }
}