<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Classes\Handlers\Bookings\Booking;


Route::post('/bookings/create', function (Request $r) {
    $numOfGuests = $r->get('numOfGuests');
    $dateOfBooking = $r->get('dateOfBooking');
    $validator = new Booking();
    $validator->validate($r);
    Cache::put($dateOfBooking, $numOfGuests, $seconds = 100);
    return response()->json(['success' => true]);
});

Route::get('/bookings/read/{dateOfBooking}', function ($dateOfBooking) {
    echo "Grabbing your booking!";
    $numOfGuests = Cache::get($dateOfBooking);
    if(!$numOfGuests){
        return response()->json(['error' => 'Booking Not found']);
    }
    return [$dateOfBooking, $numOfGuests];
});
