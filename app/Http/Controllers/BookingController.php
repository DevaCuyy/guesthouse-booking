<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\GuestHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['guestHouse', 'user'])
            ->when(Auth::user()->isAdmin(), function ($query) {
                return $query;
            }, function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create(GuestHouse $guest_house)
    {
        return view('bookings.create', compact('guest_house'));
    }

    public function store(Request $request, GuestHouse $guest_house)
    {
        $validated = $request->validate([
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'catatan' => 'nullable|string'
        ]);

        $checkin = \Carbon\Carbon::parse($validated['tanggal_checkin']);
        $checkout = \Carbon\Carbon::parse($validated['tanggal_checkout']);
        $durasi = $checkin->diffInDays($checkout);
        $totalHarga = $guest_house->harga_per_malam * $durasi;

        // Check availability
        $isBooked = Booking::where('guest_house_id', $guest_house->id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('tanggal_checkin', [$checkin, $checkout->subDay()])
                    ->orWhereBetween('tanggal_checkout', [$checkin->addDay(), $checkout]);
            })->exists();

        if ($isBooked) {
            return back()->withErrors(['tanggal_checkin' => 'Tanggal tersebut sudah dibooking!']);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'guest_house_id' => $guest_house->id,
            'tanggal_checkin' => $validated['tanggal_checkin'],
            'tanggal_checkout' => $validated['tanggal_checkout'],
            'total_harga' => $totalHarga,
            'status' => 'pending',
            'catatan' => $validated['catatan'] ?? null
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi.');
    }

    public function show(Booking $booking)
    {
        $this->authorizeBooking($booking);
        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        $this->authorizeBooking($booking);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya booking dengan status pending yang dapat dibatalkan!');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dibatalkan!');
    }

    public function confirm(Booking $booking)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking berhasil dikonfirmasi!');
    }

    public function complete(Booking $booking)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $booking->update(['status' => 'completed']);

        return back()->with('success', 'Booking telah diselesaikan!');
    }

    public function destroy(Booking $booking)
    {
        $this->authorizeBooking($booking);

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    private function authorizeBooking(Booking $booking)
    {
        if (!Auth::user()->isAdmin() && $booking->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
