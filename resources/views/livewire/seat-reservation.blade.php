<div>
    <div class=" seat-reservation-container ">
        <!-- Screen Label -->
        <h2 class="screen-label">Gradin</h2>
        @php
        use Illuminate\Support\Str;
        @endphp

        

        <!-- Seating Area -->
        <div class="seating-area">
            @foreach (['A','B','C','D','E','F','G','H','I','J','K','L','M'] as $row)
            <div class="seat-row">
                @foreach ($seats as $seat)
                    
                    @if (Str::startsWith($seat->seat_number, $row))
                        @php
                            $color="reserved";
                            if($seat->state==Auth::id())
                            {
                                $color="reservedpending";
                            }else {
                                if (( (int)$seat->state ) > 0){
                                $color="reservedpendingUsers";
                                }
                            }
                            
                        @endphp
                        <button 
                            onclick="confirmReservation({{ $seat->id_seat }}, this)"
                            class="seat {{ !$seat->available ? $color : '' }} {{ str_ends_with($seat->seat_number, 'X') ? 'reservedEmpty' : '' }}" 
                            wire:click="reserveSeat({{ $seat->id_seat }})"
                            {{ str_ends_with($seat->seat_number, 'X') ? 'desible' : '' }}
                             >
                            {{ str_ends_with($seat->seat_number, 'X') ? ' ' : $seat->seat_number }}
                        </button>
                    @endif
                    
                @endforeach
            </div>
            @endforeach
        </div>

        <p>Sol Gradin </p>
        <div class="seating-area">
            @foreach (['N','O'] as $row)
            <div class="seat-row">
                @foreach ($seats as $seat)
                    @if (Str::startsWith($seat->seat_number, $row))
                        <button 
                        onclick="confirmReservation({{ $seat->id_seat }}, this)"
                        class="seat {{ !$seat->available ? 'reserved' : '' }} {{ str_ends_with($seat->seat_number, 'X') ? 'reservedEmpty' : '' }}" 
                        wire:click="reserveSeat({{ $seat->id_seat }})"
                        {{ str_ends_with($seat->seat_number, 'X') ? 'desible' : '' }}>
                        {{ str_ends_with($seat->seat_number, 'X') ? ' ' : $seat->seat_number }}
                        </button>
                    @endif
                @endforeach
            </div>
            @endforeach
        </div>

        <p>Parterre </p>
        <div class="seating-area">
            @foreach (['P','Q','R','S','T','U','V','W','X','Y','Z'] as $row)
            <div class="seat-row">
                @foreach ($seats as $seat)
                    @if (Str::startsWith($seat->seat_number, $row))
                        <button 
                        onclick="confirmReservation({{ $seat->id_seat }}, this)"
                        class="seat {{ !$seat->available ? 'reserved' : '' }} {{ str_ends_with($seat->seat_number, 'X') ? 'reservedEmpty' : '' }}" 
                        wire:click="reserveSeat({{ $seat->id_seat }})"
                        {{ str_ends_with($seat->seat_number, 'X') ? 'desible' : '' }} 
                        >
                        {{ str_ends_with($seat->seat_number, 'X') ? ' ' : $seat->seat_number }}
                        </button>
                    @endif
                @endforeach
            </div>
            @endforeach
        </div>
        
        <h1 class="text-body">.</h1>
        <h1 class="text-body">.</h1>
        <h1 class="text-body">.</h1>
        <h1 class="text-body">.</h1>
        <h1 class="text-body">.</h1>
        <h1 class="text-body">.</h1>

    </div>



<script> 
    function confirmReservation(seatId, button) {
        // Show confirmation dialog
        const buttonText = button.textContent || button.innerText;
        if (button.classList.contains('reserved') | button.classList.contains('reservedpendingUsers')  ) { 
            //if the button(seat) is reserved  
            event.preventDefault(); //block the event 
            event.stopImmediatePropagation();
            
            }else{
                    // Check if character is '' mean buttons that's not a seat 
            if (button.innerText =='') {
                event.preventDefault();
                event.stopImmediatePropagation();
            } else {// if the seat is available it gonna ask the user if he want to reserve it 
                const confirmAction = confirm("Voulez-vous vraiment réserver ce siège?");
                if (!confirmAction) {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                }
            }

            }
        

        
    }
</script>

<style>
/* General container */
.seat-reservation-container {
    
    text-align: center;
    background-color: #000;
    padding-left: 15px;
    padding-right: 15px;
    color: #fff;
    padding: auto;
    overflow-x: auto; /* Enable horizontal scrolling */
    overflow-y: hidden; /* Enable horizontal scrolling */
    white-space: nowrap; /* Prevent wrapping of rows */
}
.seatEmpty{
    background-color: #000000;
    color: #000000;
    width: 25px;
    height: 25px;
    border: none;
    border-radius: 5px;
    padding: 0px;
    text-align: center;
    line-height: 35px;
    cursor: pointer;
    font-size: 12px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-right: 4px;
}
/* Screen label */
.screen-label {
    font-size: 24px;
    margin-bottom: 20px;
    text-transform: uppercase;
    font-weight: bold;
}

/* Seating area */
.seating-area {
    display: inline-block; /* Allows horizontal scrolling */
    margin: 0 auto;
}

/* Seat rows */
.seat-row {
    display: flex; /* Make rows align horizontally */
    margin-bottom: 8px;
}

/* Individual seats */
.seat {
    width: 25px;
    height: 25px;
    background-color: #f13b78;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 0px;
    text-align: center;
    line-height: 35px;
    cursor: pointer;
    font-size: 12px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-right: 4px;
}

.seat:hover {
    background-color: #d81b60;
}

/* Reserved seats and payed  */
.seat.reserved { 
    background-color: #383838;
    color: #6d6d6d;
    cursor: not-allowed; 
}
.seat.reservedpendingUsers{ /* Reserved seats from someone and not payed  */
    background-color: #BDBDBD;
    color: #424242;
    cursor: not-allowed; 
}

.seat.reservedpending {/* Reserved seats from current user and not payed  */
    background-color: #FFA726;
    color: #FFFFFF;
    /* cursor: not-allowed; */
}
.seat.reservedEmpty {
    background-color: #000000;
    color: #000000;
    cursor: default;
}


/* Responsive tweaks for horizontal scrolling */
@media (max-width: 768px) {
    .seat-row {
        justify-content: flex-start; /* Keep seats aligned to the left */
    }

    .seat {
        width: 25px;
        height: 25px;
        font-size: 10px;
    }

    .seat-row {
        margin-bottom: 6px;
    }
}
</style>
</div>
