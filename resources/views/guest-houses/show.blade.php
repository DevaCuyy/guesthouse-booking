@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('guest-houses.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="h-96 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center relative">
                @if($guest_house->gambar)
                    <img src="{{ Storage::url($guest_house->gambar) }}" alt="{{ $guest_house->nama }}" class="w-full h-full object-cover">
                @else
                    <svg class="w-32 h-32 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                @endif
                <span class="absolute top-4 right-4 px-3 py-1 text-sm font-semibold rounded-full {{ $guest_house->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($guest_house->status) }}
                </span>
            </div>

            <div class="p-8">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $guest_house->nama }}</h1>
                        <p class="text-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $guest_house->alamat }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($guest_house->harga_per_malam, 0, ',', '.') }}</p>
                        <p class="text-gray-500">per malam</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <svg class="w-8 h-8 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="font-semibold text-gray-900">{{ $guest_house->kapasitas }}</p>
                        <p class="text-sm text-gray-500">Kapasitas</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <svg class="w-8 h-8 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="font-semibold text-gray-900">{{ $guest_house->bookings_count }}</p>
                        <p class="text-sm text-gray-500">Total Booking</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <svg class="w-8 h-8 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        <p class="font-semibold text-gray-900">{{ $guest_house->fasilitas ? count($guest_house->fasilitas) : 0 }}</p>
                        <p class="text-sm text-gray-500">Fasilitas</p>
                    </div>
                </div>

                @if($guest_house->deskripsi)
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Deskripsi</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $guest_house->deskripsi }}</p>
                </div>
                @endif

                @if($guest_house->fasilitas)
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Fasilitas</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($guest_house->fasilitas as $fasilitas)
                            <div class="flex items-center bg-gray-50 px-4 py-2 rounded-lg">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">{{ $fasilitas }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="border-t pt-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Kelola Guest House</h2>
                            <div class="flex gap-4">
                                <a href="{{ route('guest-houses.edit', $guest_house) }}" class="px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition">
                                    Edit Guest House
                                </a>
                                <form action="{{ route('guest-houses.destroy', $guest_house) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guest house ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                                        Hapus Guest House
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        @if($guest_house->status == 'tersedia')
                        <div class="border-t pt-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Booking Guest House Ini</h2>
                            <form action="{{ route('bookings.store', $guest_house) }}" method="POST" class="bg-gray-50 p-6 rounded-lg">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Check-in</label>
                                        <input type="date" name="tanggal_checkin" min="{{ date('Y-m-d') }}" required class="w-full rounded-lg border-gray-300">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Check-out</label>
                                        <input type="date" name="tanggal_checkout" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full rounded-lg border-gray-300">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                                    <textarea name="catatan" rows="3" class="w-full rounded-lg border-gray-300" placeholder="Catatan khusus untuk booking..."></textarea>
                                </div>
                                <div class="mt-6 flex items-center justify-between">
                                    <p class="text-gray-600">Total harga akan dihitung berdasarkan durasi menginap.</p>
                                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                        Buat Booking
                                    </button>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="border-t pt-8 text-center">
                            <p class="text-red-600 font-semibold">Maaf, guest house ini sedang tidak tersedia untuk booking.</p>
                        </div>
                        @endif
                    @endif
                @else
                <div class="border-t pt-8 text-center">
                    <p class="text-gray-600 mb-4">Silakan login untuk melakukan booking.</p>
                    <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Login Sekarang
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
