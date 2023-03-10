<?php

namespace App\Classes\Handlers\Bookings;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\MessageBag;


class CarbonValidation extends \DateTime
{
    public function validateBooking(Request $r)
    {
        $r->validate([
            'dateOfBooking' => 'required|date|date_format:Y-m-d',
            'numOfGuests' => 'required|integer|min:1|max:8',
        ], [
            'date.date_format' => 'Invalid Date format, Please use YYYY-MM-DD'
        ]);

        $dateOfBooking = $r->get('dateOfBooking');
        $numOfGuests = $r->get('numOfGuests');

        $date = Carbon::parse($dateOfBooking);
        $isToday = $date->isToday();

        if ($isToday || !$date->isWeekday()) {
            print "Bookings can only be made on week days and Cannot be made on the same date of booking.";
            return false;
        }

        if (!$date->isBetween(Carbon::parse('June 1'), Carbon::parse('August 31'))) {
            print "Date MUST be between June 1 and August 31.";
            return false;
        }
        return true;
    }
}
