<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['vehicle', 'approver1', 'approver2'])->get();
        // Data untuk grafik pemakaian kendaraan
        $chartData = Vehicle::withCount('bookings')->get();
        return view('dashboard', compact('bookings', 'chartData'));
    }

    public function store(Request $request)
    {
        // Validasi data (Opsional tapi disarankan)
        $request->validate([
            'vehicle_id' => 'required',
            'driver_name' => 'required',
            'approver_1_id' => 'required',
            'approver_2_id' => 'required',
            'booking_date' => 'required|date',
        ]);

        // Simpan ke database
        $booking = \App\Models\Booking::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $request->vehicle_id,
            'driver_name' => $request->driver_name,
            'approver_1_id' => $request->approver_1_id,
            'approver_2_id' => $request->approver_2_id,
            'status' => 'pending',
            'booking_date' => $request->booking_date,
        ]);

        \Illuminate\Support\Facades\Log::info("Pemesanan baru ID {$booking->id} dibuat.");

        return back()->with('success', 'Pemesanan kendaraan berhasil dikirim!');
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $user = auth()->user();

        if ($user->id == $booking->approver_1_id && $booking->status == 'pending') {
            $booking->update(['status' => 'level_1']);
            Log::info("Booking {$id} disetujui Level 1 oleh {$user->name}");
        } elseif ($user->id == $booking->approver_2_id && $booking->status == 'level_1') {
            $booking->update(['status' => 'approved']);
            Log::info("Booking {$id} disetujui Final oleh {$user->name}");
        }

        return back()->with('success', 'Status pemesanan diperbarui.');
    }

    public function export()
    {
        return Excel::download(new BookingExport, 'laporan-pemesanan.xlsx');
    }
}
