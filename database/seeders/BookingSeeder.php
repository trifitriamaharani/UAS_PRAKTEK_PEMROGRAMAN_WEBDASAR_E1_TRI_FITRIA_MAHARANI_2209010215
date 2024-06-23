<?php
// database/seeders/BookingSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Patient;
use App\Models\Room;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua pasien dan kamar yang tersedia
        $patients = Patient::all();
        $rooms = Room::all();

        // Ambil 3 pasien acak
        $selectedPatients = $patients->random(3);

        // Ambil 6 kamar acak
        $selectedRooms = $rooms->random(6);

        // Menggunakan iterator untuk mengambil pasien secara bergantian
        $patientIterator = $selectedPatients->getIterator();

        // Looping untuk setiap kamar yang telah dipilih
        foreach ($selectedRooms as $room) {
            // Ambil pasien berikutnya (jika tidak ada, kosongkan)
            $patient = $patientIterator->valid() ? $patientIterator->current() : null;
            $patientIterator->next();

            // Buat booking jika ada pasien yang tersedia
            if ($patient) {
                Booking::create([
                    'patient_id' => $patient->id,
                    'room_id' => $room->id,
                    'check_in_date' => Carbon::now()->addDays(rand(1, 30)),
                    'check_out_date' => Carbon::now()->addDays(rand(31, 60)),
                ]);

                // Tandai kamar sebagai tidak tersedia
                $room->is_available = false;
                $room->save();
            } else {
                // Tandai kamar sebagai tersedia jika tidak ada pasien yang tersedia
                $room->is_available = true;
                $room->save();
            }
        }
    }
}

