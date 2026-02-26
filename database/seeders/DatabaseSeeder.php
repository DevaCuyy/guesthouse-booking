<?php

namespace Database\Seeders;

use App\Models\GuestHouse;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@guesthouse.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'telepon' => '081234567890',
        ]);

        // Create regular users
        User::factory(5)->create();

        // Create sample guest houses
        $guestHouses = [
            [
                'nama' => 'Villa Melati',
                'alamat' => 'Jl. Raya Puncak No. 123, Bogor',
                'deskripsi' => 'Villa nyaman dengan view pegunungan yang indah. Sangat cocok untuk keluarga yang ingin berlibur dari hiruk-pikuk kota.',
                'harga_per_malam' => 1500000,
                'kapasitas' => 4,
                'fasilitas' => ['WiFi', 'AC', 'TV', 'Kamar Mandi', 'Dapur', 'Parkir'],
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Rumah kayuhoot',
                'alamat' => 'Jl. Kaliurang KM 15, Yogyakarta',
                'deskripsi' => 'Pengalaman unik menginap di rumah kayu tradisional dengan suasana asri dan sejuk.',
                'harga_per_malam' => 850000,
                'kapasitas' => 2,
                'fasilitas' => ['WiFi', 'Kamar Mandi', 'Parkir'],
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Beachfront Cottage',
                'alamat' => 'Pantai Indah Kapuk, Jakarta',
                'deskripsi' => 'Cottage tepi pantai dengan akses langsung ke laut. Sunrise yang memukau setiap pagi.',
                'harga_per_malam' => 2200000,
                'kapasitas' => 6,
                'fasilitas' => ['WiFi', 'AC', 'TV', 'Kamar Mandi', 'Breakfast', 'Parkir'],
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Budget Homestay',
                'alamat' => 'Jl. Malioboro No. 45, Yogyakarta',
                'deskripsi' => 'Homestay ekonomis di lokasi strategis dekat dengan pusat wisata dan kuliner.',
                'harga_per_malam' => 350000,
                'kapasitas' => 2,
                'fasilitas' => ['WiFi', 'Kamar Mandi'],
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Luxury Pool Villa',
                'alamat' => 'Setiabudi, Jakarta Selatan',
                'deskripsi' => 'Villa mewah dengan private pool, jacuzzi, dan fasilitas premium lainnya.',
                'harga_per_malam' => 5500000,
                'kapasitas' => 8,
                'fasilitas' => ['WiFi', 'AC', 'TV', 'Kamar Mandi', 'Kolam Renang', 'Gym', 'Dapur', 'Parkir', 'Laundry', 'Breakfast'],
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Mountain View Lodge',
                'alamat' => 'Dieng, Wonosobo',
                'deskripsi' => 'Lodge di pegunungan dengan udara segar dan pemandangan spektakuler.',
                'harga_per_malam' => 650000,
                'kapasitas' => 4,
                'fasilitas' => ['WiFi', 'Kamar Mandi', 'Dapur', 'Parkir'],
                'status' => 'tersedia',
            ],
        ];

        foreach ($guestHouses as $gh) {
            GuestHouse::create($gh);
        }
    }
}
