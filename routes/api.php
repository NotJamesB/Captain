<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

use App\Classes\Handlers\Bookings\Booking;
use App\Classes\Handlers\Bookings\CarbonValidation;
use App\Classes\Handlers\Bookings\BookingGetter;

Route::post('/bookings/create', function ( Request $r ) 
    {
    $numOfGuests = $r->get( 'numOfGuests' );
    $dateOfBooking = $r->get( 'dateOfBooking' );

    $c = new CarbonValidation;
    if ( $c->validateBooking($r) == false ) 
    {
        return null;
    }

    $b = new Booking( $dateOfBooking, $numOfGuests );
    $b->store( $dateOfBooking, $numOfGuests );

    return response()->json( ['success' => true] );
});

Route::get( '/bookings/read/{dateOfBooking}', function ( $dateOfBooking ) {
    echo "Grabbing your booking";

    $numOfGuests = Cache::get( $dateOfBooking );

    if (  !$numOfGuests ) 
    {
        return response()->json( ['error' => 'Booking Not found'] );
    }

    return [ $dateOfBooking, $numOfGuests ];
});

// Route::get( '/bookings/read', function () 
//     {
//     echo "Grabbing your booking";

//     $b = new BookingGetter;
//     $allBookings = $b->getAllBookings();

//     if ( !$allBookings ) {
//         return response()->json(['error' => 'Booking Not found']);
//     }

//     return response()->json( $allBookings );
// });
