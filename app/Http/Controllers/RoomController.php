<?php

namespace App\Http\Controllers;

use App\Models\RoomLevel;
use App\Models\Room;
use App\Models\Patient;
use App\Models\Booking;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $availableRooms = Room::where('is_available', true)->with('roomLevel')->get();
        $bookedRooms = Room::whereHas('bookings')->with('roomLevel')->get();
        $bookings = Booking::with('patient', 'room.roomLevel')->get();

        return view('rooms.index', compact('availableRooms', 'bookedRooms', 'bookings'));
    }

    public function storeCheckIn(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string',
            'room_number' => 'required|string',
            'check_in_date' => 'required|date'
        ]);

        // Simpan data pasien
        $patient = Patient::create([
            'name' => $request->name,
        ]);

        // Cari data kamar berdasarkan nomor kamar
        $room = Room::where('room_number', $request->room_number)->first();

        // Jika kamar ditemukan dan tersedia, lakukan proses check-in
        if ($room && $room->is_available) {
            // Set kamar menjadi tidak tersedia
            $room->is_available = false;
            $room->save();

            // Simpan data booking
            Booking::create([
                'patient_id' => $patient->id,
                'room_id' => $room->id,
                'check_in_date' => $request->check_in_date,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('rooms.index')->with('success', 'Check-in successfully recorded.');
        } else {
            // Redirect dengan pesan error jika kamar tidak ditemukan atau tidak tersedia
            return redirect()->route('rooms.index')->with('error', 'Room is not available.');
        }
    }

    public function storeCheckOut(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string',
            'room_number' => 'required|string',
            'check_out_date' => 'required|date'
        ]);

        // Cari data kamar berdasarkan nomor kamar
        $room = Room::where('room_number', $request->room_number)->first();

        // Jika kamar ditemukan dan sedang dibooking, lakukan proses check-out
        if ($room) {
            $booking = Booking::where('room_id', $room->id)
                ->whereHas('patient', function ($query) use ($request) {
                    $query->where('name', $request->name);
                })
                ->whereNull('check_out_date')
                ->first();

            if ($booking) {
                // Update tanggal check-out pada booking
                $booking->check_out_date = $request->check_out_date;
                $booking->save();

                // Set kamar menjadi tersedia
                $room->is_available = true;
                $room->save();

                // Redirect dengan pesan sukses
                return redirect()->route('rooms.index')->with('success', 'Check-out successfully recorded.');
            } else {
                // Redirect dengan pesan error jika booking tidak ditemukan
                return redirect()->route('rooms.index')->with('error', 'No active booking found for this room and patient.');
            }
        } else {
            // Redirect dengan pesan error jika kamar tidak ditemukan
            return redirect()->route('rooms.index')->with('error', 'Room not found.');
        }
    }
}
