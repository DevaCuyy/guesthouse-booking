<?php

namespace App\Http\Controllers;

use App\Models\GuestHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestHouseController extends Controller
{
    public function index()
    {
        $guestHouses = GuestHouse::latest()->paginate(10);
        return view('guest-houses.index', compact('guestHouses'));
    }

    public function show(GuestHouse $guest_house)
    {
        return view('guest-houses.show', compact('guest_house'));
    }

    public function create()
    {
        return view('guest-houses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|array',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:tersedia,tidak_tersedia'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('guest-houses', 'public');
            $validated['gambar'] = $gambar;
        }

        GuestHouse::create($validated);

        return redirect()->route('guest-houses.index')
            ->with('success', 'Guest House berhasil ditambahkan!');
    }

    public function edit(GuestHouse $guestHouse)
    {
        return view('guest-houses.edit', compact('guestHouse'));
    }

    public function update(Request $request, GuestHouse $guestHouse)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|array',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:tersedia,tidak_tersedia'
        ]);

        if ($request->hasFile('gambar')) {
            if ($guestHouse->gambar && Storage::exists('public/' . $guestHouse->gambar)) {
                Storage::delete('public/' . $guestHouse->gambar);
            }
            $gambar = $request->file('gambar')->store('guest-houses', 'public');
            $validated['gambar'] = $gambar;
        }

        $guestHouse->update($validated);

        return redirect()->route('guest-houses.index')
            ->with('success', 'Guest House berhasil diperbarui!');
    }

    public function destroy(GuestHouse $guestHouse)
    {
        if ($guestHouse->gambar && Storage::exists('public/' . $guestHouse->gambar)) {
            Storage::delete('public/' . $guestHouse->gambar);
        }

        $guestHouse->delete();

        return redirect()->route('guest-houses.index')
            ->with('success', 'Guest House berhasil dihapus!');
    }
}
