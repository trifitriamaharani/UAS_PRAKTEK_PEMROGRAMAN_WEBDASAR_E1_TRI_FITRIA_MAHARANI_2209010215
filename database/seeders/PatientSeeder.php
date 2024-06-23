<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data pasien
        Patient::create([
            'name' => 'Joe',
            // tambahkan kolom lainnya sesuai kebutuhan
        ]);

        Patient::create([
            'name' => 'Jane',]);

            Patient::create([
                'name' => 'Noa',]);
    }
}
