<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Classes\Handlers\Bookings\Booking;
use App\Classes\Handlers\Bookings\CarbonValidation;

Route::post('/bookings/create', function (Request $r) 
{
    $numOfGuests = $r->get('numOfGuests');
    $dateOfBooking = $r->get('dateOfBooking');

    $c = new CarbonValidation;
    if ($c->validateBooking($r) == false) {
        return null;
    }

    $b = new Booking();
    $b->store($dateOfBooking, $numOfGuests);

    return response()->json(['success' => true]);
});

Route::get('/bookings/read', function () 
{

    $b = new Booking;
    $r = $b->getBookings();
    if (!$r) {
        return response()->json(['error' => 'Booking Not found']);
    }

    return $r;
});
