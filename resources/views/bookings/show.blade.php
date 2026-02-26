@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('bookings.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Booking
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-white">Detail Booking #{{ $booking->id }}</h1>
                    @switch($booking->status)
                        @case('pending')
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @break
                        @case('confirmed')
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>
                            @break
                        @case('completed')
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                            @break
                        @case('cancelled')
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                            @break
                    @endswitch
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Guest House</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-medium text-gray-900">{{ $booking->guestHouse->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Alamat</p>
                                <p class="text-gray-900">{{ $booking->guestHouse->alamat }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Harga per Malam</p>
                                <p class="font-medium text-gray-900">Rp {{ number_format($booking->guestHouse->harga_per_malam, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Booking</h3>
                        <div class="space-y-3">
                            @if(auth()->user()->isAdmin())
                                <div>
                                    <p class="text-sm text-gray-500">Customer</p>
                                    <p class="font-medium text-gray-900">{{ $booking->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $booking->user->email }}</p>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm text-gray-500">Check-in</p>
                                <p class="font-medium text-gray-900">{{ $booking->tanggal_checkin->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Check-out</p>
                                <p class="font-medium text-gray-900">{{ $booking->tanggal_checkout->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Durasi</p>
                                <p class="font-medium text-gray-900">{{ $booking->durasi }} malam</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($booking->catatan)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Catatan</h3>
                    <p class="text-gray-600 bg-gray-50 p-4 rounded-lg">{{ $booking->catatan }}</p>
                </div>
                @endif

                <div class="border-t pt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ringkasan Pembayaran</h3>
                        <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <p class="text-gray-500 text-sm">Total untuk {{ $booking->durasi }} malam</p>
                </div>

                <div class="border-t pt-8 mt-8 flex gap-4 flex-wrap">
                    @if($booking->status == 'pending')
                        @if(auth()->user()->isAdmin())
                            <form action="{{ route('bookings.confirm', $booking) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                                    Konfirmasi Booking
                                </button>
                            </form>
                        @else
                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition" onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                    Batalkan Booking
                                </button>
                            </form>
                        @endif
                    @endif

                    @if($booking->status == 'confirmed' && auth()->user()->isAdmin())
                        <form action="{{ route('bookings.complete', $booking) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                Tandai Selesai
                            </button>
                        </form>
                    @endif

                    @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition" onclick="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
