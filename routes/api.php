<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Classes\Handlers\Bookings\Booking;

// Route::post('/booking/create', function (Request $r) {
//     // // dd($numOfGuests);
//     $numOfGuests = $r->get('numOfGuests');
//     $dateOfBooking = $r->get('dateOfBooking');
//     $b = new Booking($numOfGuests, $dateOfBooking);
//     Cache::put('numOfGuests', $numOfGuests, $seconds = 100);
//     Cache::put('dateOfBooking', $dateOfBooking, $seconds = 100);
//     echo "Successfully Created a Booking!";
// });

// Route::get('/booking/read', function () {
//     echo "Grabbing your booking!";
//     return [
//         Cache::get('numOfGuests'),
//         Cache::get('dateOfBooking')

//     ];
// });

Route::get('/bookings/read', [Booking::class, 'getBooking']);
Route::post('/bookings/create', [Booking::class, 'handler']);


