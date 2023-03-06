<?php

namespace App\Classes\Handlers\Bookings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Classes\Handlers\Bookings\Validator;


//This class validates given
class Booking {
    public function __construct(String $dateOfBooking, Int $numOfGuests)
    {
        $this->$dateOfBooking = $dateOfBooking;
       $this->$numOfGuests = $numOfGuests;
    }
    public function check (Request $r)
    {
        $r->validate([
            'dateOfBooking' => 'required|date|date_format:m-d-Y',
            'numOfGuests' => 'required|integer|min:1|max:8',
        ],[
            'date.date_format' => 'Invalid Date format, Please use YYYY-MM-DD'
        ]);
    }

    public function store($dateOfBooking, $numOfGuests)
    {
        Cache::put($dateOfBooking, $numOfGuests, $seconds = 1000);
    }
    
};