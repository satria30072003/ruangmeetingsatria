<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    
public function index()
{
    $rooms = Room::with('images')->get();
    return view('landing', compact('rooms'));
}
}