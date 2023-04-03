<?php

namespace App\Classes\Handlers\Bookings;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CarbonValidation extends \DateTime
{
    public function validateBooking(Request $r)
    {
        $r->validate([
            'dateOfBooking' => 'required|date|date_format:Y-m-d',
        ], [
            'date.date_format' => 'Invalid Date format, Please use YYYY-MM-DD',
        ]);

        $dateOfBooking = $r->get('dateOfBooking');
        $numOfGuests = $r->get('numOfGuests');

        $date = Carbon::parse($dateOfBooking);
        $isToday = $date->isToday();

        if ($isToday || !$date->isWeekday()) 
        {
            print "Bookings can only be made on week days and Cannot be made on the same date of booking.";

            return false;
        }

        $bookings = Cache::tags('booking')->get('bookings');

        if (isset($bookings[$dateOfBooking])) 
        {
            print "A booking already exists on this date.";

            return false;
        }

        if ($numOfGuests >= 9) 
        {
            print "The maximum amount of guests per day is 8";

            return false;
        }

        $currentYearStart = Carbon::parse('June 1st 2023');
        $currentYearEnd = Carbon::parse('August 31st 2023');
        $nextYearStart = Carbon::parse('June 1st 2024');
        $nextYearEnd = Carbon::parse('August 31st 2024');

        if (!$date->isBetween($currentYearStart, $currentYearEnd) && !$date->isBetween($nextYearStart, $nextYearEnd)) 
        {
            print "Date MUST be between June 1 and August 31 of The current or next year.";

            return false;
        }

        return true;
    }
}
