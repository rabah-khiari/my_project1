<?php

namespace App\Livewire;

use App\Models\Reservation;
use Livewire\Component;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SeatReservation extends Component
{
    public $seats = []; // Holds all seats from the database
    public $reservedSeats = []; // Holds seat numbers that are reserved

    public function freeReservedAfter10Min() {

        $currentTimestamp = now()->timestamp - 1 * 60 ; // Current time in seconds 1 * 60 sec mean after 60 second will disapear 
        $currentTimestamp = date('Y-m-d H:i:s', $currentTimestamp);
        
        $expiredReservations = Reservation::where('status', 'pending')
        ->where('reservation_date', '<', $currentTimestamp) // Check if it's over 10 minutes
        ->get();

        foreach ($expiredReservations as $reservation) {

            // Also update the seat's availability
            $reservation->seat->update([
                'available' => true,
                'state'=>0,
            ]);
            $reservation->delete();
        }
        

    }
    public function mount()
    {
        // Load all seats on component mount
        $this->freeReservedAfter10Min();
        $this->seats = Seat::all();
        //dd($this->seats);
    }

    public function reserveSeat($seatId)
    {
        //$updatedRows = Seat::where('available', false)->update(['seat_number' => '00']);
        //dd($updatedRows);

        // DB::table('seats')
        // ->where('available', false) // Filter rows where reservation is true
        // ->update([
        //     'seat_number' => DB::raw("CONCAT(seat_number, 'X')") // Concatenate 'X' to seat_number
        // ]);
        // dd("updatedRows");
        // Find the seat by ID

        $seat = Seat::find($seatId);
        $user_id= Auth::id();
       
        if ($seat && $seat->available) {
            // Reserve the seat by setting 'available' to false
            $seat->available = false; //reserve the seat 
            $seat->state=$user_id; //save user id 
            $seat->save();
            //create a reservation with the time to begin counting to 10min 
            $seat = Reservation::create([
                'id_user' => $user_id,
                'id_seat' => $seatId,
                'reservation_date' => now(),
                'status' => "pending"
            ]);

            //verify if there is any seats exceed the 10min time to turn it available state 
            $this->freeReservedAfter10Min();

            // Refresh the seats data
            $this->seats = Seat::all();

        }else{
            //mean if state ==0 -> there is no one take this seat or if state== current user_id : the user can free the seat 
            if (!((int) $seat->state > 0) || $seat->state ==$user_id)
            {
                $seat->available = true;
                $seat->state=0;
                $seat->save();
               
                //verify if there is any seats exceed the 10min time to turn it available state
                $this->freeReservedAfter10Min();
                // Refresh the seats data
                $this->seats = Seat::all();
            }
            
        }
    }

    public function render()
    {
        //$this->seats = Seat::all();
    return view('livewire.seat-reservation', ['seats' => $this->seats]);

    }
}
