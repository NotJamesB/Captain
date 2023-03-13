<?php

namespace App\Classes\Handlers\Bookings;

use Illuminate\Support\Facades\Cache;

class BookingGetter
{
    public function getAllBookings()
    {
        $bookings = [];

        $keys = Cache::get()->keys( 'booking_*' );
        foreach ( $keys as $key ) 
        {
            $dateOfBooking = str_replace( 'booking_', '', $key );
        }

        $numOfGuests = Cache::get( $key );

        $bookings[] = 
        [
            'dateOfBooking' => $dateOfBooking,
            'numOfGuests' => $numOfGuests,
        ];

        return $bookings;
    }
}
