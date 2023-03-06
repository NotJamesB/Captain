<?php

namespace App\Classes\Handlers\Bookings;

use Illuminate\Http\Request;
use Carbon\Carbon;


class Validator{

    // public function check (Request $r)
    // {
    //     $r->validate([
    //         'dateOfBooking' => 'required|date|date_format:m-d-Y',
    //         'numOfGuests' => 'required|integer|min:1|max:8'
    //     ],[
    //         'date.date_format' => 'Invalid Date format, Please use YYYY-MM-DD'
    //     ]);
    // }

//     public function validation(Request $r){
//         $dateOfBooking = Carbon::parse($r['dateOfBooking']);
//         if(!$dateOfBooking->isWeekday() || ! $dateOfBooking->isBetween(Carbon::parse('June 1'), Carbon::parse('August 31'))){
//             return false;
//         }

//         $now = Carbon::now();
//         $currentYear = $now->year;
//         $nextYear = $currentYear +1;
//         $latestDate = Carbon::parse("August 31, $nextYear");
//         if($dateOfBooking->greaterThan($latestDate)){
//             return false;
//         }

//         if($dateOfBooking->isToday()){
//             return false;
//         }
//     }

}