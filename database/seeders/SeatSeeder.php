<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //creat the rows 
        // $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        // $totalSeats = 34;

        // foreach ($rows as $row) {
        //     for ($i = 1; $i <= $totalSeats; $i++) {
        //         Seat::firstOrCreate(['seat_number' => $row.$i]);
        //     }
        // }

        
        //faire la numerotation 
        // $car="Z";
        // $seats = DB::table('seats')
        //     ->where('seat_number', 'LIKE', $car.'%') // Starts with 'B'
        //     ->where('seat_number', 'NOT LIKE', '%X') // Does not end with 'X'
        //     ->get();
        
        // foreach ($seats as $seat) {
        //     // Extract numeric part after 'B'
        //     $numericPart = (int)substr($seat->seat_number, 1);

        //     // Check if numeric part is > 7
        //     if ($numericPart > 9) {
        //         // Increment by 3
        //         $newSeatNumber =   $car. ($numericPart -9 );

        //         // Update the seat in the database
        //         DB::table('seats')
        //             ->where('id_seat', $seat->id_seat)
        //             ->update(['seat_number' => $newSeatNumber]);
        //     }
            
        // }
        DB::table('seats')->update(['state' => 0, 'available' => 1]);


    }
    
}

