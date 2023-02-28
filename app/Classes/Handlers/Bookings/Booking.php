<?php

namespace App\Classes\Handlers\Bookings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

//This class validates given
class Booking {
    // protected $numOfGuests;
    // protected $dateOfBooking;

    // public function __construct($numOfGuests, $dateOfBooking)
    // {
    //     $this->numOfGuests = $numOfGuests;
    //     $this->dateOfBooking = $dateOfBooking;
    // }

    public function getBooking()
    {
        $rNum = Cache::get('numOfGuests');
        $rDate = Cache::get('dateOfBooking');
        return [$rNum, $rDate];
    }
    public function handler(Request $r){
        $r->validate([
            'numOfGuests' => 'required|max:8',
            'dateOfBooking' => 'required'
        ]);
        new Booking;
        Cache::put('numOfGuests', $r->numOfGuests, $seconds = 100);
        Cache::put('dateOfBooking', $r->dateOfBooking, $seconds = 100);
        echo("Successfully Validated!");
    }

};