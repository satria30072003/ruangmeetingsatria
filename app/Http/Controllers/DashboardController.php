<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservasi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $rooms = Room::all();
        $roomNames = [];
        $roomCounts = [];

        foreach ($rooms as $room) {
            $roomNames[] = $room->name;
            $count = Reservasi::where('room_id', $room->id)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();
            $roomCounts[] = $count;
        }

        return view('dashboard.index', compact('roomNames', 'roomCounts'));
    }
}