<?php

namespace App\Classes\Handlers\Bookings;

use Illuminate\Support\Facades\Cache;

class Booking
{

    public function store($dateOfBooking, $numOfGuests)
    {
        $bookings = Cache::tags('booking')->get('bookings') ?? [];
        $bookings[$dateOfBooking] = $numOfGuests;
        Cache::tags('booking')->put('bookings', $bookings);
    }

    public function getBookings()
    {
        return Cache::tags('booking')->get('bookings') ?? [];
    }
};
