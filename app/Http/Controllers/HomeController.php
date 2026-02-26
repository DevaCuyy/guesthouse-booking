<?php

namespace App\Http\Controllers;

use App\Models\GuestHouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $guestHouses = GuestHouse::where('status', 'tersedia')
            ->withCount('bookings')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('guestHouses'));
    }
}
