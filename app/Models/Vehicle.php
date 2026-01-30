<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'name',
        'type',
        'ownership',
        'plate_number',
        'fuel_consumption'
    ];

    /**
     * Relasi ke model Booking.
     * Satu kendaraan bisa memiliki banyak riwayat pemesanan.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}