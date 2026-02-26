@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('guest-houses.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Guest House</h1>

            <form action="{{ route('guest-houses.update', $guestHouse) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Guest House</label>
                        <input type="text" name="nama" value="{{ old('nama', $guestHouse->nama) }}" required class="w-full rounded-lg border-gray-300 @error('nama') border-red-500 @enderror">
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" required class="w-full rounded-lg border-gray-300 @error('alamat') border-red-500 @enderror">{{ old('alamat', $guestHouse->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="5" class="w-full rounded-lg border-gray-300">{{ old('deskripsi', $guestHouse->deskripsi) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Malam (Rp)</label>
                            <input type="number" name="harga_per_malam" value="{{ old('harga_per_malam', $guestHouse->harga_per_malam) }}" min="0" required class="w-full rounded-lg border-gray-300 @error('harga_per_malam') border-red-500 @enderror">
                            @error('harga_per_malam')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas (orang)</label>
                            <input type="number" name="kapasitas" value="{{ old('kapasitas', $guestHouse->kapasitas) }}" min="1" required class="w-full rounded-lg border-gray-300">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach(['WiFi', 'AC', 'TV', 'Kamar Mandi', 'Dapur', 'Parkir', 'Kolam Renang', 'Gym', 'Laundry', 'Breakfast'] as $fasilitas)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas }}" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ (old('fasilitas', $guestHouse->fasilitas ?? []) && in_array($fasilitas, old('fasilitas', $guestHouse->fasilitas ?? []))) ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">{{ $fasilitas }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    @if($guestHouse->gambar)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                        <img src="{{ Storage::url($guestHouse->gambar) }}" alt="{{ $guestHouse->nama }}" class="w-48 h-32 object-cover rounded-lg">
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Baru</label>
                        <input type="file" name="gambar" accept="image/*" class="w-full rounded-lg border-gray-300">
                        <p class="text-gray-500 text-sm mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full rounded-lg border-gray-300">
                            <option value="tersedia" {{ old('status', $guestHouse->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak_tersedia" {{ old('status', $guestHouse->status) == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Update Guest House
                    </button>
                    <a href="{{ route('guest-houses.index') }}" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
