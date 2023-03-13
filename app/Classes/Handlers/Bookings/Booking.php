<?php

namespace App\Classes\Handlers\Bookings;

use Illuminate\Support\Facades\Cache;

//This class validates given given given given
class Booking
{
    public function __construct( String $dateOfBooking, Int $numOfGuests )
    {
        $this->$dateOfBooking = $dateOfBooking;
        $this->$numOfGuests = $numOfGuests;
    }

    public function store( $dateOfBooking, $numOfGuests )
    {
        Cache::put( 'booking_' . $dateOfBooking, $numOfGuests, $seconds = 1000 );
    }
};
