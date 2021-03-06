<?php

namespace App\Http\Controllers;

use App\User;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookingRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bookings.index');
    }

    public function getAllBookings()
    {
        $bookings = Booking::with('user', 'flight', 'parking', 'service', 'from_city', 'to_city')->latest()->get();
        
        return response()->json($bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        if ($request->hasFile('image')) 
        {
            $image = request()->file('image');
            $imageName = $image->getClientOriginalName();
            $path ='/uploads/bookings/'.$imageName;
                // storing an image
                $image->move(public_path('/uploads/bookings'), $imageName);

                $booking = Booking::create([
                    'user_id' => Auth::user()->id,
                    'service_id' => $request->input('service_id'),
                    'from_city_id' => $request->input('from_city_id'),
                    'to_city_id' => $request->input('to_city_id'),
                    'date' => $request->input('date'),
                    'address' => $request->input('address'),
                    'flight_id' => $request->input('flight_id'),
                    'parking_id' => $request->input('parking_id'),
                    'distance' => $request->input('distance'),
                    'image' => $path,
                ]);
        } else {
            $booking = Booking::create([
                'user_id' => Auth::user()->id,
                'service_id' => $request->input('service_id'),
                'from_city_id' => $request->input('from_city_id'),
                'to_city_id' => $request->input('to_city_id'),
                'date' => $request->input('date'),
                'address' => $request->input('address'),
                'flight_id' => $request->input('flight_id'),
                'parking_id' => $request->input('parking_id'),
                'distance' => $request->input('distance'),
            ]);
        }
        
        return response()->json(['message' => 'Your Booking request has been submitte, you will be notfied through email once your booking gets confirmed']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        $updated_status = "Booking Request approved";
        $booking->update([
            'total' => $request->input('total'),
            'status' => $updated_status,
        ]);

        return response()->json(['message' => 'Booking request approved']);
    }

    public function trackBooking(Request $request)
    {
        $user = User::find(Auth::user()->id); //for retrieving order related to the logged-in user
        $booking = Booking::where('booking_number', $request->booking_number)
                            ->where('user_id', $user->id)->latest()->first();

        return response()->json($booking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
