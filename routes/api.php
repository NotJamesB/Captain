<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Classes\Handlers\Bookings\Booking;

Route::post('/bookings/create', function (Request $r) {
    $r->validate([
        'dateOfBooking' => 'required|date_format:Y-m-d',
        'numOfGuests' => 'required|integer|min:1|max:8'
    ],[
        'date.date_format' => 'Invalid Date format, Please use YYYY-MM-DD'
    ]);
    $numOfGuests = $r->get('numOfGuests');
    $dateOfBooking = $r->get('dateOfBooking');
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



// Route::get('/bookings/read', [Booking::class, 'getBooking']);
// Route::post('/bookings/create', [Booking::class, 'handler']);



/* 

This API 
POST /bookings/create: receives date (day/month/year) and numOfGuests (integer). Using query parameters is fine.

GET/bookings/read: an array of bookings, where trip dates are keys and number of booked guests are values. Only return dates with bookings.

*/