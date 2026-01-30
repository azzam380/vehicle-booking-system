<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'vehicle_id', 
        'driver_name', 
        'approver_1_id', 
        'approver_2_id', 
        'status', 
        'booking_date'
    ];

    // Relasi balik ke Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relasi ke User (sebagai Approver 1)
    public function approver1()
    {
        return $this->belongsTo(User::class, 'approver_1_id');
    }

    // Relasi ke User (sebagai Approver 2)
    public function approver2()
    {
        return $this->belongsTo(User::class, 'approver_2_id');
    }
}