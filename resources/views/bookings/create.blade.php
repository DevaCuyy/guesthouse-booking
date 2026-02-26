@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Booking Guest House</h1>
            <p class="text-gray-600 mt-2">{{ $guest_house->nama }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('bookings.store', $guest_house) }}" method="POST">
                @csrf

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Guest House</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-medium">{{ $guest_house->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-medium">{{ $guest_house->alamat }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Harga per Malam</p>
                                <p class="font-medium">Rp {{ number_format($guest_house->harga_per_malam, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kapasitas</p>
                                <p class="font-medium">{{ $guest_house->kapasitas }} orang</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Deskripsi</p>
                            <p class="font-medium">{{ $guest_house->deskripsi }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Booking</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggal_checkin" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Check-in
                            </label>
                            <input type="date" id="tanggal_checkin" name="tanggal_checkin"
                                   value="{{ old('tanggal_checkin') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_checkin') border-red-500 @enderror"
                                   required>
                            @error('tanggal_checkin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_checkout" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Check-out
                            </label>
                            <input type="date" id="tanggal_checkout" name="tanggal_checkout"
                                   value="{{ old('tanggal_checkout') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_checkout') border-red-500 @enderror"
                                   required>
                            @error('tanggal_checkout')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan Tambahan (Opsional)
                    </label>
                    <textarea id="catatan" name="catatan" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Tambahkan catatan khusus jika ada...">{{ old('catatan') }}</textarea>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('guest-houses.show', $guest_house) }}"
                       class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Buat Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Set minimum date for check-in to today
    document.getElementById('tanggal_checkin').min = new Date().toISOString().split('T')[0];

    // Update check-out minimum when check-in changes
    document.getElementById('tanggal_checkin').addEventListener('change', function() {
        const checkinDate = new Date(this.value);
        checkinDate.setDate(checkinDate.getDate() + 1);
        document.getElementById('tanggal_checkout').min = checkinDate.toISOString().split('T')[0];
    });
</script>
@endsection
