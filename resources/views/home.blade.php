@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-blue-600">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-800 to-blue-600"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Temukan Guest House Impian Anda
            </h1>
            <p class="mt-6 text-xl text-blue-100 max-w-3xl mx-auto">
                Pesan guest house nyaman dan terjangkau dengan mudah. Banyak pilihan guest house terbaik await Anda.
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <a href="{{ route('guest-houses.index') }}" class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                    Lihat Guest Houses
                </a>
                @guest
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-blue-700 text-white font-semibold rounded-lg hover:bg-blue-800 border border-blue-500 transition">
                        Daftar Sekarang
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Mengapa Memilih Kami?</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Mudah & Cepat</h3>
                <p class="text-gray-600">Proses booking yang simple dan cepat hanya dalam beberapa langkah.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Harga Terjangkau</h3>
                <p class="text-gray-600">Nikmati harga kompetitif dengan fasilitas lengkap.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 mx-auto bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Layanan 24/7</h3>
                <p class="text-gray-600">Tim support siap membantu Anda kapan saja.</p>
            </div>
        </div>
    </div>
</div>

<!-- Guest Houses Section -->
@if($guestHouses->count() > 0)
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Guest House Populer</h2>
            <a href="{{ route('guest-houses.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                Lihat Semua &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($guestHouses as $guestHouse)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        @if($guestHouse->gambar)
                            <img src="{{ Storage::url($guestHouse->gambar) }}" alt="{{ $guestHouse->nama }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $guestHouse->nama }}</h3>
                        <p class="text-gray-600 text-sm mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ Str::limit($guestHouse->alamat, 50) }}
                        </p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <span class="mr-4">{{ $guestHouse->kapasitas }} orang</span>
                            @if($guestHouse->fasilitas)
                                <span>{{ count($guestHouse->fasilitas) }} fasilitas</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($guestHouse->harga_per_malam, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-500">/malam</span>
                        </div>
                        <a href="{{ route('guest-houses.show', $guestHouse) }}" class="mt-4 block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- CTA Section -->
@guest
<div class="py-16 bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Untuk Memesan?</h2>
        <p class="text-xl text-blue-100 mb-8">Daftar sekarang dan nikmati kemudahan booking guest house.</p>
        <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
            Daftar Gratis
        </a>
    </div>
</div>
@endguest
@endsection
