<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $totalSeats = 34;

        foreach ($rows as $row) {
            for ($i = 1; $i <= $totalSeats; $i++) {
                Seat::firstOrCreate(['seat_number' => $row.$i]);
            }
        }
    }
}
