<?php

namespace App\Classes\Handlers\Bookings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

//This class validates given
class Booking {
    public function validate (Request $r)
    {
        $r->validate([
            'dateOfBooking' => 'required|date_format:Y-m-d',
            'numOfGuests' => 'required|integer|min:1|max:8'
        ],[
            'date.date_format' => 'Invalid Date format, Please use YYYY-MM-DD'
        ]);
    }
};