<?php
namespace App\Classes\Handlers\Bookings;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class CarbonValidation extends \DateTime
{
    public function validation(Request $r){
        $dateOfBooking = $r->get('dateOfBooking');
        $numOfGuests = $r->get('numOfGuests');

        $date = Carbon::parse($dateOfBooking);

        if($date->isToday())
        {
            return response()->json(['error' => 'This booking is today']);
        }
    }

}