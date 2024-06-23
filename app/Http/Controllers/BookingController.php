<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Patient;
use App\Models\Room;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            // 'check_out_date' => 'required|date|after_or_equal:check_in_date',
        ]);

        $room = Room::find($request->room_id);

        if ($room->is_available > 0) {
            $booking = Booking::create([
                'patient_id' => $request->patient_id,
                'room_id' => $request->room_id,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date ?? null, // optional
            ]);

            // Kurangi ketersediaan kamar
            $room->decrement('is_available');

            return redirect()->route('rooms.index')->with('success', 'Booking created successfully.');
        }

        return redirect()->back()->withErrors(['room_id' => 'The selected room is not available.']);
    }

    public function checkOut(Request $request, Booking $booking)
    {
        $booking->update([
            'check_out_date' => now(),
        ]);

        // Tambah ketersediaan kamar
        $room = $booking->room;
        $room->increment('is_available');

        return redirect()->route('rooms.index')->with('success', 'Checked out successfully.');
    }
}
