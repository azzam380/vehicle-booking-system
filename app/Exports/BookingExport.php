<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Booking::with(['vehicle', 'approver1', 'approver2'])
            ->get()
            ->map(function($b) {
                return [
                    $b->id,
                    $b->vehicle->name,
                    $b->driver_name,
                    $b->approver1->name,
                    $b->approver2->name,
                    $b->status,
                    $b->booking_date,
                ];
            });
    }

    public function headings(): array
    {
        return ["ID", "Kendaraan", "Driver", "Penyetuju 1", "Penyetuju 2", "Status", "Tanggal"];
    }
}