<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_house_id',
        'tanggal_checkin',
        'tanggal_checkout',
        'total_harga',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_checkin' => 'date',
        'tanggal_checkout' => 'date',
        'total_harga' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guestHouse()
    {
        return $this->belongsTo(GuestHouse::class);
    }

    public function getDurasiAttribute()
    {
        return $this->tanggal_checkin->diffInDays($this->tanggal_checkout);
    }
}
