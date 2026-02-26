@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Guest House</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('guest-houses.create') }}" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition">
                        Tambah Guest House
                    </a>
                @endif
            @endauth
        </div>

        <!-- Search & Filter -->
        <form method="GET" class="mb-8 bg-white p-4 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="search" placeholder="Cari guest house..." value="{{ request('search') }}" class="rounded-lg border-gray-300">
                <select name="status" class="rounded-lg border-gray-300">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak_tersedia" {{ request('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                <input type="number" name="min_price" placeholder="Harga Min" value="{{ request('min_price') }}" class="rounded-lg border-gray-300">
                <input type="number" name="max_price" placeholder="Harga Max" value="{{ request('max_price') }}" class="rounded-lg border-gray-300">
            </div>
            <div class="mt-4 flex gap-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
                <a href="{{ route('guest-houses.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Reset</a>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($guestHouses as $guestHouse)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center relative">
                        @if($guestHouse->gambar)
                            <img src="{{ Storage::url($guestHouse->gambar) }}" alt="{{ $guestHouse->nama }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        @endif
                        <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full {{ $guestHouse->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($guestHouse->status) }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $guestHouse->nama }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($guestHouse->alamat, 60) }}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                            <span>{{ $guestHouse->kapasitas }} orang</span>
                            @if($guestHouse->fasilitas)
                                <span>{{ count($guestHouse->fasilitas) }} fasilitas</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($guestHouse->harga_per_malam, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-500">/malam</span>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('guest-houses.show', $guestHouse) }}" class="flex-1 block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Lihat Detail
                            </a>
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('guest-houses.edit', $guestHouse) }}" class="px-3 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('guest-houses.destroy', $guestHouse) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guest house ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('bookings.create', $guestHouse) }}" class="flex-1 block text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                        Booking
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Tidak ada guest house ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $guestHouses->links() }}
        </div>
    </div>
</div>
@endsection
