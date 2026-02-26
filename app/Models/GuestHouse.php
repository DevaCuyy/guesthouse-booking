<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'deskripsi',
        'harga_per_malam',
        'kapasitas',
        'fasilitas',
        'gambar',
        'status'
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'harga_per_malam' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
